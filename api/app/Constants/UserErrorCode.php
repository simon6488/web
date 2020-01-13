<?php
declare(strict_types=1);
/**
 * This file is part of Yunhu.
 * @link https://www.yunhuyj.com
 * @contact shunfei.xia@yunhuyj.com
 */

namespace App\Constants;


use Hyperf\Constants\AbstractConstants;

class UserErrorCode extends AbstractConstants
{
    /**
     * @Message('用户名或者密码错误')
     */
    const USER_OR_PASSWORD_IS_WRONG = 1001;

    /**
     * @Message('用户名被冻结')
     */
    const USER_FROZEN = 1002;

    /**
     * @Message('用户已存在')
     */
    const USER_EXIST = 1003;
}