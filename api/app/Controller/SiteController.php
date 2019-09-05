<?php
declare(strict_types=1);

namespace App\Controller;

use App\Constants\ErrorCode;
use App\Exception\ApiException;
use App\Repository\UserRepository;
use App\Validate\SiteValidate;

class SiteController extends Controller
{

    /**
     * 用户登录
     * @param UserRepository $userRepository
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function login(UserRepository $userRepository)
    {
        $data = $this->request->all();
        $v = SiteValidate::check($data);
        if ($v->isFail()) {
            throw new ApiException(ErrorCode::VALIDATE_ERROR, $v->firstError());
        }
        return $this->success(ErrorCode::HTTP_OK, "登录成功", $userRepository->login($v->getSafeData()));
    }
}