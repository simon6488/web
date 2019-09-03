<?php
declare(strict_types=1);

namespace App\Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'nickname',//昵称
        'mobile',//手机号
        'username',//账号
        'password',//密码
        'status'//状态（0-正常 1-禁用）
    ];
}