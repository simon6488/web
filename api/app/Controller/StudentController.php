<?php
declare(strict_types=1);

namespace App\Controller;


use App\Constants\ErrorCode;
use App\Exception\ApiException;
use App\Repository\StudentRepository;
use App\Validate\StudentValidate;
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
        $data = $this->request->all();
        return $this->success(ErrorCode::HTTP_OK, "", $this->studentRepository->getStudent($data));
    }

    /**
     * 新增学生
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function store()
    {
        $data = $this->request->all();
        $v = StudentValidate::check($data);
        if ($v->isFail()) {
            throw new ApiException($v->firstError(), ErrorCode::VALIDATE_ERROR);
        }
        return $this->success(ErrorCode::HTTP_OK, "保存成功", $this->studentRepository->addStudent($v->getSafeData()));
    }

    /**
     * 编辑学生
     * @param int $id
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function update(int $id)
    {
        $data = $this->request->all();
        $v = StudentValidate::check($data);
        if ($v->isFail()) {
            throw new ApiException($v->firstError(), ErrorCode::VALIDATE_ERROR);
        }
        return $this->success(ErrorCode::HTTP_OK, "保存成功", $this->studentRepository->update($id, $v->getSafeData()));
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