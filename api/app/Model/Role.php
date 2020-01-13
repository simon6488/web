<?php
declare(strict_types=1);

namespace App\Model;


class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'id',
        'role_name',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}