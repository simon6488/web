<?php
declare(strict_types=1);

namespace App\Exception;


use App\Constants\UserErrorCode;
use Hyperf\Server\Exception\ServerException;
use Throwable;

class UserException extends ServerException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        if (is_null($message)) {
            $message = UserErrorCode::getMessage($code);
        }
        parent::__construct($message, $code, $previous);
    }
}