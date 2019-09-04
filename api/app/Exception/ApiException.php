<?php
/**
 * Created by PhpStorm.
 * @copyright:  杭州云呼网络科技有限公司
 * @author  Shunfei.Xia<shunfei.xia@yunhuyj.com>
 * Date: 2019/9/4
 * Time: 13:48
 */

namespace App\Exception;


use Hyperf\Server\Exception\ServerException;
use Throwable;

class ApiException extends ServerException
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}