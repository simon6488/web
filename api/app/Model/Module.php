<?php
declare(strict_types=1);

namespace App\Model;


class Module extends Model
{
    protected $table = 'modules';

    protected $fillable = [
        'id',//主键
        'module_name',//模块名称
        'module_path',//模块路径
        'parent_id',//父模块id
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}