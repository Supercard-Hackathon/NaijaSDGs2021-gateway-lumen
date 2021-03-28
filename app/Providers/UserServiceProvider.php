<?php

namespace App\Providers;

use Schema;
use Illuminate\Support\ServiceProvider;
use App\Repositories\UserRepository;
use App\Repositories\Interfaces\UserInterface;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register User repository service
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            UserInterface::class, 
            UserRepository::class
        );
    }
}
