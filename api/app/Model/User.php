<?php
declare(strict_types=1);

namespace App\Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'id',//主键
        'nickname',//昵称
        'mobile',//手机号
        'username',//账号
        'password',//密码
        'status',//状态（0-正常 1-禁用）
        'open_id',//小程序的open_id
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $hidden = [
        'password'
    ];
}