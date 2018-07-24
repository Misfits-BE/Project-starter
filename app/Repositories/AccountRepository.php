<?php

namespace App\Repositories;

use App\Repositories\Database\EloquentRepository;
use App\Interfaces\AccountRepositoryInterface;
use App\User;
use Illuminate\Contracts\Pagination\Paginator;

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

    /**
     * Get all the users from the storage based on role.
     *
     * @param  null|string $role The user role from the collection. Defaults to all
     * @return Paginator
     */
    public function getUsersByRole(string $role = 'all'): Paginator
    {
        switch ($role) { // Determination block for the query.
            case 'Admin': case 'User': // If role is User Or Admin
                return $this->model->role($role)->simplePaginate();
            default: // By default return all users
                return $this->model->simplePaginate();
        }
    }
}