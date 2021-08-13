<?php
declare(strict_types=1);

namespace App\Repository;

use App\Constants\ErrorCode;
use App\Exception\ApiException;
use App\Service\ExcelService;
use App\Service\FileService;
use App\Validate\GradeValidate;
use Hyperf\DbConnection\Db;
use Hyperf\Di\Annotation\Inject;

class GradeRepository extends BaseRepository
{
    /**
     * @Inject
     * @var ExcelService
     */
    private $excelService;

    /**
     * @Inject
     * @var StudentRepository
     */
    private $studentRepository;

    function model()
    {
        return 'App\Model\Grade';
    }

    /**
     * 获取成绩列表
     * @param array $data
     * @return array
     */
    public function getGrade(array $data): array
    {
        $where = [
            'status' => 0
        ];
        if (isset($data['student_id'])) {
            $where['student_id'] = $data['student_id'];
        }

        if (isset($data['name'])) {
            $where[] = ['student_id', 'in', $this->studentRepository->findWhere([['name', 'like', '%' . $data['name'] . '%']])->pluck('student_id')->toArray()];
        }

        if (isset($data['grade'])) {
            $where['grade'] = $data['grade'];
        }

        if (isset($data['term'])) {
            $where['term'] = $data['term'];
        }

        $data = $this->where($where)
            ->orderBy('grade', 'desc')
            ->orderBy('term', 'desc')
            ->orderBy('student_id', 'asc')
            ->paginate(10)->toArray();
        if ($data['total']) {
            $studentIds = array_column($data['equipment'], 'student_id');
            $studentInfo = $this->studentRepository->findWhere([['student_id', 'in', $studentIds]], ['student_id', 'name', 'gender'])->toArray();
            $studentInfo = array_combine(array_column($studentInfo, 'student_id'), $studentInfo);
            $data['equipment'] = array_map(function ($row) use ($studentInfo) {
                $row['name'] = isset($studentInfo[$row['student_id']]) ? $studentInfo[$row['student_id']]['name'] : '';
                $row['gender'] = isset($studentInfo[$row['student_id']]) ? $studentInfo[$row['student_id']]['gender'] : '';
                return $row;
            }, $data['equipment']);
        }
        return $data;
    }

    /**
     * 新增或者更新成绩
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function addOrUpdateGrade(array $data, int $id = 0): bool
    {
        $v = GradeValidate::check($data, [], [], 'store');
        if ($v->isFail()) {
            throw new ApiException(ErrorCode::VALIDATE_ERROR, $v->firstError());
        }
        $data = $v->getSafeData();
        $data[$data['type']] = $data['point'];
        unset($data['type'], $data['point']);
        if ($id) {
            $this->update($id, $data);
        } else {
            $this->updateOrCreate([
                'student_id' => $data['student_id'],
                'grade' => $data['grade'],
                'term' => $data['term'],
                'status' => 0
            ], $data);
        }
        return true;
    }

    /**
     * 批量导入成绩
     * @param array $data
     * @return bool
     */
    public function upload(array $data): bool
    {
        $v = GradeValidate::check($data, [], [], 'upload');
        if ($v->isFail()) {
            throw new ApiException(ErrorCode::VALIDATE_ERROR, $v->firstError());
        }
        $data = $v->getSafeData();
        $fileName = FileService::upload($data['file']);
        $re = $this->excelService->setFilePath($fileName)->read();
        if ($re) {
            Db::transaction(function () use ($data, $re) {
                foreach ($re as $row) {
                    $attributes = [
                        'grade' => $data['grade'],
                        'term' => $data['term'],
                        'student_id' => $row['student_id']
                    ];
                    $values = $attributes + [$data['type'] => $re['point']];
                    $this->updateOrCreate($attributes, $values);
                }
            });
        }
        return true;
    }

    /**
     * 删除成绩
     * @param int $id
     * @return bool
     */
    public function deleteGrade(int $id): bool
    {
        $this->update($id, ['status' => -1]);
        return true;
    }
}