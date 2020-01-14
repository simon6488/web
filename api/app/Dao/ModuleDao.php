<?php
declare(strict_types=1);

namespace App\Dao;


use App\Model\Module;

class ModuleDao extends BaseDao
{
    public function create(array $data): bool
    {
        // TODO: Implement create() method.
    }

    public function update(array $data): bool
    {
        // TODO: Implement update() method.
    }

    public function delete(int $id): bool
    {
        // TODO: Implement delete() method.
    }

    public function find(int $id): array
    {
        // TODO: Implement find() method.
    }

    public function findByModulePath(string $path): array
    {
        $module = Module::where('module_path', $path)->first();
        return $module ? $module->toArray() : [];
    }
}