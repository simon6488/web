<?php
declare(strict_types=1);

namespace App\Repository;


use App\Constants\ErrorCode;
use App\Exception\ApiException;

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
        return $this->where($where)->orderBy('student_id', 'asc')->paginate(10)->toArray();
    }

    /**
     * 新增学生
     * @param array $data
     * @return bool
     */
    public function addStudent(array $data): bool
    {
        if ($this->findWhere(['name' => $data['name'], ['status', '>=', 0]])->count() > 0) {
            throw new ApiException(ErrorCode::VALIDATE_ERROR, "学生已存在");
        }
        $this->create($data);
        return true;
    }
}