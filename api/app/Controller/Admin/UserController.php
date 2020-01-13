<?php
declare(strict_types=1);

namespace App\Controller\Admin;


use App\Controller\Controller;
use App\Service\Impls\UserImpl;
use Hyperf\Di\Annotation\Inject;

class UserController extends Controller
{
    /**
     * @Inject()
     * @var UserImpl
     */
    private $userImpl;

    public function index()
    {

    }

    public function store()
    {
        return $this->success($this->userImpl->create($this->request->all()));
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}