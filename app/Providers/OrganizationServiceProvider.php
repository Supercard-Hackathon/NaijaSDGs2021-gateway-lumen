<?php

namespace App\Providers;

use Schema;
use Illuminate\Support\ServiceProvider;
use App\Repositories\GroupRepository;
use App\Repositories\OrganizationRepository;
use App\Repositories\Interfaces\GroupInterface;
use App\Repositories\Interfaces\OrganizationInterface;

class OrganizationServiceProvider extends ServiceProvider
{
    /**
     * Register branch and organization repository services
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            OrganizationInterface::class, 
            OrganizationRepository::class
        );

        $this->app->bind(
            GroupInterface::class, 
            GroupRepository::class
        );
    }
}
