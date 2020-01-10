<?php
declare(strict_types=1);

namespace App\Service\Impls;


use App\Dao\UserDao;
use App\Service\Interfaces\UserImplInterface;
use Hyperf\Di\Annotation\Inject;

class UserImpl extends BaseImpl implements UserImplInterface
{
    /**
     * @Inject()
     * @var UserDao
     */
    protected $userDao;

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
        // TODO: Implement findOne() method.
    }

    public function findPaginate(array $data): array
    {
        // TODO: Implement findPaginate() method.
    }

    public function delete(int $id): array
    {
        // TODO: Implement delete() method.
    }
}