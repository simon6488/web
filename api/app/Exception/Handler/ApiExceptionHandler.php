<?php
/**
 * Created by PhpStorm.
 * @copyright:  杭州云呼网络科技有限公司
 * @author  Shunfei.Xia<shunfei.xia@yunhuyj.com>
 * Date: 2019/9/4
 * Time: 13:45
 */

namespace App\Exception\Handler;


use App\Exception\ApiException;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class ApiExceptionHandler extends ExceptionHandler
{
    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        // 判断被捕获到的异常是希望被捕获的异常
        if ($throwable instanceof ApiException) {
            // 格式化输出
            $data = json_encode([
                'code' => $throwable->getCode(),
                'message' => $throwable->getMessage(),
            ], JSON_UNESCAPED_UNICODE);

            // 阻止异常冒泡
            $this->stopPropagation();
            return $response->withStatus($throwable->getCode())
                ->withHeader('Content-Type', 'application/json')
                ->withBody(new SwooleStream($data));
        }
    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}