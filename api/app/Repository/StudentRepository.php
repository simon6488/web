<?php
declare(strict_types=1);

namespace App\Repository;


use App\Constants\ErrorCode;
use App\Exception\ApiException;
use App\Validate\StudentValidate;

class StudentRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Model\Student';
    }

    /**
     * 获取学生列表
     * @param array $data
     * @return array
     */
    public function getStudent(array $data): array
    {
        $where = [
            ['status', '>=', 0]
        ];
        if (isset($data['student_id'])) {
            $where['student_id'] = $data['student_id'];
        }

        if (isset($data['name'])) {
            $where[] = ['name', 'like', '%' . trim($data['name']) . '%'];
        }

        if (isset($data['contact'])) {
            $where['contact'] = $data['contact'];
        }
        return $this->where($where)->orderBy('student_id', 'asc')->paginate($data['per_page'] ?? 10)->toArray();
    }

    /**
     * 新增或者更新学生
     * @param array $data
     * @return bool
     */
    public function addOrUpdateStudent(array $data, int $id = 0): bool
    {
        $v = StudentValidate::check($data);
        if ($v->isFail()) {
            throw new ApiException(ErrorCode::VALIDATE_ERROR, $v->firstError());
        }
        $data = $v->getSafeData();
        if ($id == 0 && $this->findWhere(['name' => $data['name'], ['status', '>=', 0]])->count() > 0) {
            throw new ApiException(ErrorCode::VALIDATE_ERROR, "学生已存在");
        }
        if ($id) {
            $this->update($id, $data);
        } else {
            $this->create($data);
        }
        return true;
    }

    /**
     * 删除学生
     * @param int $id
     * @return bool
     */
    public function deleteStudent(int $id): bool
    {
        $this->update($id, ['status' => -1]);
        return true;
    }
}