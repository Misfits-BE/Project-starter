<?php

namespace App\Repositories\Acl;

use App\Interfaces\Acl\PermissionRepositoryInterface;
use App\Repositories\Database\EloquentRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

/**
 * Class PermissionRepository
 *
 * @package App\Repositories\Acl
 */
class PermissionRepository extends EloquentRepository implements PermissionRepositoryInterface
{
    /**
     * The resource model.
     *
     * @return string
     */
    public function getModel(): string
    {
        return Permission::class;
    }

    /**
     * Get the default defined permissions for the application.
     *
     * @todo   Implement config variable for the default permissions.
     * @return array
     */
    public function defaultPermissions(): array
    {
        return [];
    }

    /**
     * Get all the resources from the storage.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * Find the first resource of create the resource in the storage.
     *
     * @param  array $data The fragment from the resource that need to be find or created.
     * @return Model
     */
    public function firstOrCreate(array $data): Model
    {
        return $this->model->firstOrCreate($data);
    }

    public function getUserPermissions(): Collection
    {
        return $this->model->where('name', 'LIKE', 'view_%')->get();
    }
}