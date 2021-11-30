<?php

namespace App\Domains\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class RepositoryAbstract
{
    /**
     * @var Model
     */
    protected $model;

    public function createModel()
    {
        return $this->makeModel();
    }

    public function makeModel()
    {
        $model = app()->make($this->model);
        if (!$model instanceof Model) {
           throw new \Exception('Model inexistente');
        }
        return $this->model = $model;
    }

    public function create(array $attributes = [])
    {
        $instance = $this->makeModel();
        $instance->fill($attributes);
        $instance->save();
        return $instance;
    }
    
    public function createWithManualTimestamp(array $attributes = [])
    {
        $instance = $this->makeModel();
        $instance->timestamps = false;
        $instance->fill($attributes);
        $instance->save();
        return $instance;
    }
    public function update($id, array $attributes = [])
    {
        $instance = $id instanceof Model ? $id : $this->find($id);
        if ($instance) {
            $instance->fill($attributes);
            $instance->save();
        }
        return $instance;
    }
    public function updateWithManualTimestamp($id, array $attributes = [])
    {
        $instance = $id instanceof Model ? $id : $this->find($id);
        $instance->timestamps = false;
        if ($instance) {
            $instance->fill($attributes);
            $instance->save();
        }
        return $instance;
    }
    public function delete($id)
    {
        $instance = $id instanceof Model ? $id : $this->find($id);
        if ($instance) {
            $instance->delete();
        }
        return $instance;
    }
    public function batchDelete(array $wheres)
    {
        return $this->query()->where($wheres)->delete();
    }
    public function find($id)
    {
        return $this->makeModel()::find($id);
    }
    public function query()
    {
        return $this->makeModel()::query();
    }
    public function findBy($key, $values): ?Model
    {
        return $this->createModel()->where($key, '=', $values)->first();
    }
    public function findAllBy(string $key, string $values): Collection
    {
        return $this->createModel()->where($key, '=', $values)->get();
    }
    public function findAll(): Collection
    {
        return $this->createModel()->get();
    }
    public function all(): Collection
    {
        return $this->findAll();
    }
    public function findWhere(array $where): Collection
    {
        [$attribute, $operator, $value, $boolean] = array_pad($where, 4, null);
        return $this->createModel()->where($attribute, $operator, $value, $boolean)->get();
    }
    public function findWhereIn(array $where): Collection
    {
        [$attribute, $operator, $value, $boolean] = array_pad($where, 4, null);
        return $this->createModel()->whereIn($attribute, $operator, $value, $boolean)->get();
    }
    public function findOneByWhere(array $where): ?Model
    {
        return $this->createModel()->where($where)->orderBy('id', 'DESC')->first();
    }
    public function findWheres(array $wheres): Collection
    {
        return $this->createModel()->where($wheres)->get();
    }
}