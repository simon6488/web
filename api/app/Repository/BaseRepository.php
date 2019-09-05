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
            throw new ApiException(ErrorCode::SERVER_ERROR, "Class {$this->model()} must be an instance of Hyperf\\Database\\Model\\Model");
        }
        return $this->model = $model;
    }

    protected function resetModel()
    {
        $this->makeModel();
    }

    /**
     * where单字段查询
     * @param string $field
     * @param null $value
     * @param array $columns
     * @return mixed
     */
    public function findByField(string $field, $value = null, $columns = ['*'])
    {
        $model = $this->model->where($field, '=', $value)->get($columns);
        $this->resetModel();
        return $model;
    }

    /**
     * where多条件查询
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
     * where
     * @param array $where
     * @return $this
     */
    public function where(array $where)
    {
        $this->applyConditions($where);
        return $this;
    }

    /**
     * paginate
     * @param int $limit
     * @param array $columns
     * @return mixed
     */
    public function paginate($limit = 10, $columns = ['*'])
    {
        $results = $this->model->paginate($limit, $columns);
        $this->resetModel();
        return $results;
    }

    /**
     * orderBy
     * @param $column
     * @param string $direction
     * @return $this
     */
    public function orderBy($column, $direction = 'asc')
    {
        $this->model = $this->model->orderBy($column, $direction);
        return $this;
    }

    /**
     * insert data
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        $model = $this->model->newInstance($attributes);
        if (!$model->save()) {
            throw new ApiException(ErrorCode::SERVER_ERROR, "插入数据失败");
        }
        $this->resetModel();
        return $model;
    }

    /**
     * update by primary key
     * @param int $id
     * @param array $attributes
     * @return mixed
     */
    public function update(int $id, array $attributes)
    {
        $model = $this->model->find($id);
        if (!$model) {
            throw new ApiException(ErrorCode::NOT_FOUND, "记录不存在");
        }
        $model->fill($attributes);
        if (!$model->save()) {
            throw new ApiException(ErrorCode::SERVER_ERROR, "更新数据失败");
        }
        return $model;
    }

    /**
     * update or create
     * @param array $attributes
     * @param array $values
     * @return mixed
     */
    public function updateOrCreate(array $attributes, array $values = [])
    {
        $model = $this->model->updateOrCreate($attributes, $values);
        $this->resetModel();
        return $model;
    }

    /**
     * update by where
     * @param array $where
     * @param array $attributes
     * @return bool
     */
    public function updateWhere(array $where, array $attributes): bool
    {
        $this->applyConditions($where);
        $this->model->update($attributes);
        $this->resetModel();
        return true;
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