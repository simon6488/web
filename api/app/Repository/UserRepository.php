<?php
declare(strict_types=1);

namespace App\Repository;


use App\Constants\ErrorCode;
use App\Exception\ApiException;
use App\Service\CacheService;

class UserRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Model\User';
    }

    public function login(array $data): array
    {
        $user = $this->findByField('username', $data['username'])->first();
        if (!$user || !password_verify($data['password'], $user->password)) {
            throw new ApiException(ErrorCode::AUTHENTICATION_INVALID, "用户名或者密码错误");
        }

        if ($user->status) {
            throw new ApiException(ErrorCode::AUTHENTICATION_REFUSED, "账号被冻结");
        }
        $value = [
            'id' => $user->id,
            'username' => $user->username,
            'nickname' => $user->nickname
        ];
        $token = md5(json_encode($value, JSON_UNESCAPED_UNICODE));
        $value['token'] = $token;
        CacheService::setex($token, $value, 3600);
        return $value;
    }
}