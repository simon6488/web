<?php
declare(strict_types=1);

namespace App\Model;

class Grade extends Model
{
    protected $table = 'grades';

    protected $fillable = [
        'student_id',//学号
        'grade',//年级
        'term',//学期
        'a_first',//一A
        'a_second',//二A
        'a_third',//三A
        'a_fourth',//四A
        'a_mid',//期中A
        'a_fifth',//五A
        'a_sixth',//六A
        'a_seventh',//七A
        'a_eighth',//八A
        'a_final',//期末A
        'b_final'//期末B
    ];
}