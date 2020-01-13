<?php
declare(strict_types=1);

namespace App\Service\Interfaces;


interface UserImplInterface
{
    /**
     * 登录
     * @param array $data
     * @return array
     */
    public function login(array $data): array;

    /**
     * 登出
     * @return bool
     */
    public function logout(): bool;
}