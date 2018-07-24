<?php

namespace App\Interfaces;

use App\User;

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
}