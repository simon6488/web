<?php
declare(strict_types=1);

namespace App\Middleware;

use App\Constants\ErrorCode;
use App\Exception\ApiException;
use App\Service\CacheService;
use FastRoute\RouteParser\Std;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Utils\Context;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthMiddleware implements MiddlewareInterface
{
    /**
     * @Inject
     * @var RequestInterface
     */
    private $request;

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (($token = $this->request->header('token')) != null) {
            $user = CacheService::get($token);
            if (!$user) {
                throw new ApiException(ErrorCode::AUTHENTICATION_INVALID, "登录失效");
            }
            Context::set('auth', $user);
            CacheService::setex($token, $user, 3600);
        } else {
            throw new ApiException(ErrorCode::AUTHENTICATION_REFUSED, "没有权限");
        }
        return $handler->handle($request);
    }
}