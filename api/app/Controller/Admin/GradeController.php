<?php
declare(strict_types=1);

namespace App\Controller\Admin;


use App\Constants\ErrorCode;
use App\Controller\Controller;
use App\Repository\GradeRepository;
use Hyperf\Di\Annotation\Inject;

class GradeController extends Controller
{
    /**
     * @Inject
     * @var GradeRepository
     */
    private $gradeRepository;

    public function index()
    {
        return $this->success(ErrorCode::HTTP_OK, "", $this->gradeRepository->getGrade($this->request->all()));
    }

    /**
     * 新增单个人的成绩
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function store()
    {
        return $this->success(ErrorCode::HTTP_OK, "保存成功", $this->gradeRepository->addOrUpdateGrade($this->request->all(), 0));
    }

    /**
     * 批量导入成绩
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function upload()
    {
        return $this->success(ErrorCode::HTTP_OK, "导入成功", $this->gradeRepository->upload($this->request->all()));
    }

    /**
     * 更新单个人的成绩
     * @param int $id
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function update(int $id)
    {
        return $this->success(ErrorCode::HTTP_OK, "保存成功", $this->gradeRepository->addOrUpdateGrade($this->request->all(), $id));
    }

    /**
     * 删除成绩
     * @param int $id
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function delete(int $id)
    {
        return $this->success(ErrorCode::HTTP_OK, "删除成功", $this->gradeRepository->deleteGrade($id));
    }
}