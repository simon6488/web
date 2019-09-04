<?php
declare(strict_types=1);

namespace App\Repository;


use App\Constants\ErrorCode;
use App\Exception\ApiException;
use Hyperf\Database\Model\Model;
use Psr\Container\ContainerInterface;

abstract class BaseRepository
{
    protected $container;

    protected $model;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->makeModel();
    }

    abstract public function model();

    public function makeModel()
    {
        $model = $this->container->get($this->model());

        if (!$model instanceof Model) {
            throw new ApiException("Class {$this->model()} must be an instance of Hyperf\\Database\\Model\\Model", ErrorCode::SERVER_ERROR);
        }
        return $this->model = $model;
    }

    protected function resetModel()
    {
        $this->makeModel();
    }

    /**
     * where查询
     * @param array $where
     * @param array $columns
     * @return mixed
     */
    public function findWhere(array $where, $columns = ['*'])
    {
        $this->applyConditions($where);
        $model = $this->model->get($columns);
        $this->resetModel();
        return $model;
    }

    /**
     *where条件分配
     * @param array $where
     */
    protected function applyConditions(array $where)
    {
        foreach ($where as $field => $value) {
            if (is_array($value)) {
                list($field, $condition, $val) = $value;
                $this->model = $this->model->where($field, $condition, $val);
            } else {
                $this->model = $this->model->where($field, '=', $value);
            }
        }
    }
}