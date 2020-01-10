<?php
declare(strict_types=1);

namespace App\Model;


class Student extends Model
{
    protected $table = 'students';

    protected $fillable = [
        'id',//主键
        'student_number',//学号
        'name',//学生姓名
        'gender',//学生性别（1-男孩 2-女孩）
        'status',//学生状态 0-有效 1-失效
        'contact',//联系方式,家长手机号
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}