<?php
declare(strict_types=1);
/**
 * This file is part of Yunhu.
 * @link https://www.yunhuyj.com
 * @contact shunfei.xia@yunhuyj.com
 */

namespace App\Request;


use Hyperf\Di\Annotation\Inject;
use Hyperf\Validation\ValidatorFactory;

class BaseRequest
{
    /**
     * @Inject()
     * @var ValidatorFactory
     */
    protected $validatorFactory;
}