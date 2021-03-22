<?php

namespace App\Providers;

use Schema;
use Illuminate\Support\ServiceProvider;
use App\Repositories\MainRepository;
use App\Repositories\Interfaces\MainInterface;

class MainServiceProvider extends ServiceProvider
{
    /**
     * Register Main repository service
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            MainInterface::class, 
            MainRepository::class
        );
    }
}
