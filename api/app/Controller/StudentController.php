<?php
declare(strict_types=1);

namespace App\Controller;

use App\Constants\ErrorCode;
use App\Repository\StudentRepository;
use Hyperf\Di\Annotation\Inject;

class StudentController extends Controller
{
    /**
     * @Inject
     * @var StudentRepository
     */
    private $studentRepository;


    /**
     * 获取学生列表
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function index()
    {
        return $this->success(ErrorCode::HTTP_OK, "", $this->studentRepository->getStudent($this->request->all()));
    }

    /**
     * 新增学生
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function store()
    {
        return $this->success(ErrorCode::HTTP_OK, "保存成功", $this->studentRepository->addOrUpdateStudent($this->request->all()));
    }

    /**
     * 编辑学生
     * @param int $id
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function update(int $id)
    {
        return $this->success(ErrorCode::HTTP_OK, "保存成功", $this->studentRepository->addOrUpdateStudent($this->request->all(), $id));
    }

    /**
     * 删除学生
     * @param int $id
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function delete(int $id)
    {
        return $this->success(ErrorCode::HTTP_OK, "删除成功", $this->studentRepository->update($id, ['status' => -1]));
    }
}