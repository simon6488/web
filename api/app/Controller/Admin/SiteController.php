<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Controller;
use App\Service\Impls\UserImpl;

class SiteController extends Controller
{

    /**
     * 用户登录
     * @param UserImpl $userImpl
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function login(UserImpl $userImpl)
    {
        return $this->success($userImpl->login($this->request->all()));
    }
}