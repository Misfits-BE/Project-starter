<?php

namespace App\Interfaces\Acl;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface PermissionRepositoryInterface
 *
 * @package App\Interfaces\Acl
 */
interface PermissionRepositoryInterface
{
    /**
     * Get the default defined permissions for the application.
     *
     * @return array
     */
    public function defaultPermissions(): array;

    /**
     * Get all the resources from the storage.
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Find the first resource of create the resource in the storage.
     *
     * @param  array $data The fragment from the resource that needs to be find or created.
     * @return Model
     */
    public function firstOrCreate(array $data): Model;

    /**
     * Get all the permissions for normal users in the storage
     *
     * @return Collection
     */
    public function getUserPermissions(): Collection;
}