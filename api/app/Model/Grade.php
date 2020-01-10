<?php
declare(strict_types=1);

namespace App\Model;

class Grade extends Model
{
    protected $table = 'grades';

    protected $fillable = [
        'student_id',//学生主键
        'grade',//年级
        'term',//学期
        'subject',//学科
        'score',//具体成绩
        'status',//0-正常 -1删除
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}