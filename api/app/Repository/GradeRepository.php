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

    function model()
    {
        return 'App\Model\Grade';
    }

    /**
     * 批量导入成绩
     * @param array $data
     * @return bool
     */
    public function upload(array $data): bool
    {
        $v = GradeValidate::check($data);
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
}