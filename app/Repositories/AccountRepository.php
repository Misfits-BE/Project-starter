<?php

namespace App\Repositories;

use App\Repositories\Database\EloquentRepository;
use App\Interfaces\AccountRepositoryInterface;
use App\User;

/**
 * Class UserRepository
 *
 * @package App\Repositories
 */
class AccountRepository extends EloquentRepository implements AccountRepositoryInterface
{
    /**
     * Get the resource model.
     *
     * @return string
     */
    public function getModel(): string
    {
        return User::class;
    }

    /**
     * Get a user resource from the storage. Is no id is given return authenticated user.
     *
     * @param  int|null $userId The unique resource identifier from the user.
     * @return User
     */
    public function getUser(?int $userId = null): User
    {
        if (is_null($userId)) {
            return $this->model->find(auth()->user()->id);
        }

        return $this->model->find($userId);
    }
}