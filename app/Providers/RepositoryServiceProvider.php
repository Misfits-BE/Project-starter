<?php

namespace App\Providers;

use App\Interfaces\AccountRepositoryInterface;
use App\Interfaces\Acl\PermissionRepositoryInterface;
use App\Interfaces\Acl\RoleRepositoryInterface;
use App\Repositories\AccountRepository;
use App\Repositories\Acl\PermissionRepository;
use App\Repositories\Acl\RoleRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 *
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(AccountRepositoryInterface::class, AccountRepository::class);
        $this->app->singleton(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->singleton(PermissionRepositoryInterface::class, PermissionRepository::class);
    }
}
