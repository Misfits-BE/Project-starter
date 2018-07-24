<?php

namespace App\Interfaces\Acl;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface RoleRepositoryInterface
 *
 * @package App\Interfaces\Acl
 */
interface RoleRepositoryInterface
{
    /**
     * Find the first resource of create the resource in the database.
     *
     * @param  array $data The fragment from the resource that needs to be find or created.
     * @return Model
     */
    public function firstOrCreate(array $data): Model;
}