<?php
declare(strict_types=1);

namespace App\Service\Impls;


use App\Service\Interfaces\StudentImplInterface;

class StudentImpl extends BaseImpl implements StudentImplInterface
{
    public function create(array $data): bool
    {
        // TODO: Implement create() method.
    }

    public function update(array $data): bool
    {
        // TODO: Implement update() method.
    }

    public function findOne(int $id): array
    {
        // TODO: Implement findOneStudent() method.
    }

    public function findPaginate(array $data): array
    {
        // TODO: Implement findStudentsPaginate() method.
    }

    public function delete(int $id): array
    {
        // TODO: Implement delete() method.
    }
}