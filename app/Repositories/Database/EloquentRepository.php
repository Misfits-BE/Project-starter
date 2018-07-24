<?php

namespace App\Repositories\Database;

use App\Interfaces\RepositoryInterface;

/**
 * Class EloquentRepository
 *
 * @package App\Repositories
 */
abstract class EloquentRepository implements RepositoryInterface
{
    /** @var \Illuminate\Database\Eloquent\Model $model */
    protected $model;

    /**
     * EloquentRepository constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * Get the resource model
     *
     * @return string
     */
    abstract protected function getModel(): string;

    /**
     * Set the resource model for the repository
     *
     * @return void
     */
    public function setModel(): void
    {
        $this->model = app()->make($this->getModel());
    }

    /**
     * Get all resources from the storage
     *
     * @param  array $columns The columns u need from the resource
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll(array $columns = ['*'])
    {
        return $this->model->all($columns);
    }

    /**
     * Find a specific resource in the storage.
     *
     * @param  mixed $id The identifier from the resource
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Create a new resource in the storage.
     *
     * @param  array $attributes The attributes and their values for the new resources
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * Update a resource in the storage
     * @param  mixed $id            The identifier from the resource
     * @param  array $attributes    The newly attributes with their data for the resource.
     * @return bool|mixed
     */
    public function update($id, array $attributes)
    {
        if ($result = $this->find($id)->update($attributes)) {
            return $result;
        }

        return false;
    }

    /**
     * Make a new instance of the entity to query on.
     *
     * @param array $relations The needed relation entitities
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function make(array $relations = [])
    {
        return $this->model->with($relations);
    }

    /**
     * Return all results that have a required relationship.
     *
     * @param  string $relation The name for the relation
     * @param  array  $with     The with required param.
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|
     *         \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]|
     *         \Illuminate\Support\Collection
     */
    public function has(string $relation, array $with = [])
    {
        $entity = $this->make($with);
        return $entity->has($relation)->get();
    }

    /**
     * Find a signel entity by key value.
     *
     * @param  string $key      The column name
     * @param  string $value    The column value
     * @param  array  $with     The needed relationships
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function getFirstBy(string $key, string $value, array $with = [])
    {
        return $this->make($with)->where($key, $value)->firstOrFail();
    }

    /**
     * Find many attributes by key value.
     *
     * @param  string $key      The column name
     * @param  string $value    The column value
     * @param  array  $with     The needed relationships
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|
     *         \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function getManyBy(string $key, string $value, array $with = [])
    {
        return $this->make($with)->where($key, $value)->get();
    }
}