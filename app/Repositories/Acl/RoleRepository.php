<?php

namespace App\Repositories\Acl;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use App\Repositories\Database\EloquentRepository;
use App\Interfaces\Acl\RoleRepositoryInterface;

/**
 * Class RoleRepository
 *
 * @package App\Repositories\Acl
 */
class RoleRepository extends EloquentRepository implements RoleRepositoryInterface
{
    /**
     * Get the resource model.
     *
     * @return string
     */
    public function getModel(): string
    {
        return Role::class;
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
}