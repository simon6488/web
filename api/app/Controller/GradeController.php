<?php
declare(strict_types=1);

namespace App\Controller;


use App\Constants\ErrorCode;
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

    }

    public function store()
    {

    }

    /**
     * 批量导入成绩
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function upload()
    {
        return $this->success(ErrorCode::HTTP_OK, "导入成功", $this->gradeRepository->upload($this->request->all()));
    }

    public function update(int $id)
    {

    }

    public function delete(int $id)
    {

    }
}