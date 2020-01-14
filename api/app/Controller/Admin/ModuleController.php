<?php
declare(strict_types=1);

namespace App\Controller\Admin;


use App\Controller\Controller;
use App\Service\Impls\ModuleImpl;
use Hyperf\Di\Annotation\Inject;

class ModuleController extends Controller
{
    /**
     * @Inject()
     * @var ModuleImpl
     */
    private $moduleImpl;

    public function index()
    {
        return $this->success($this->moduleImpl->create($this->request->all()));
    }

    public function store()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }
}