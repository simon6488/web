<?php
declare(strict_types=1);
/**
 * This file is part of Yunhu.
 * @link https://www.yunhuyj.com
 * @contact shunfei.xia@yunhuyj.com
 */

namespace App\Constants;


use Hyperf\Constants\AbstractConstants;

class ModuleErrorCode extends AbstractConstants
{
    /**
     * @Message("模块路径已存在")
     */
    const MODULE_PATH_EXIST = 2001;
}