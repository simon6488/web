<?php
declare(strict_types=1);

namespace App\Exception;


use App\Constants\ModuleErrorCode;
use Hyperf\Server\Exception\ServerException;
use Throwable;

class ModuleException extends ServerException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        if (is_null($message)) {
            $message = ModuleErrorCode::getMessage($code);
        }
        parent::__construct($message, $code, $previous);
    }
}