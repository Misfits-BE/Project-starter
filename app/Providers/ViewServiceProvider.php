<?php

namespace App\Providers;

use App\Http\ViewComposers\GlobalComposer;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        view()->composer('*', GlobalComposer::class);
    }
}
