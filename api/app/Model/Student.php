<?php
declare(strict_types=1);

namespace App\Model;


class Student extends Model
{
    protected $table = 'students';

    protected $fillable = [
        'student_id',//学号
        'name',//学生姓名
        'gender',//学生性别（1-男孩 2-女孩）
        'status',//学生状态 0-有效 1-失效
        'contact'//家长手机号
    ];
}