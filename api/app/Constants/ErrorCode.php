<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\Constants;

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

/**
 * @Constants
 */
class ErrorCode extends AbstractConstants
{
    /**
     * @Message("Success")
     */
    const HTTP_OK = 200;

    const VALIDATE_ERROR = 422;

    const AUTHENTICATION_INVALID = 401;

    const AUTHENTICATION_REFUSED = 403;

    const NOT_FOUND = 404;

    const SERVER_ERROR = 500;
}
