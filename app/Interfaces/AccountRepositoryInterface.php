<?php

namespace App\Interfaces;

use App\User;
use Illuminate\Contracts\Pagination\Paginator;

/**
 * Interface UserRepositoryInterface
 *
 * @package App\Interfaces
 */
interface AccountRepositoryInterface
{
    /**
     * Get a user resource from the storage. Is no id is given return authenticated user.
     *
     * @param  int|null $userId The resource identifier in the storage
     * @return User
     */
    public function getUser(?int $userId = null): User;

    /**
     * Get all the users from the storage based on role.
     *
     * @param  null|string $role The user role from the collection. Defaults to all
     * @return Paginator
     */
    public function getUsersByRole(string $role = 'all'): Paginator;
}