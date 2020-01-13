<?php
declare(strict_types=1);

namespace App\Service\Interfaces;


interface RoleImplInterface
{
    /**
     * 角色列表
     * @return array
     */
    public function findList(): array;
}