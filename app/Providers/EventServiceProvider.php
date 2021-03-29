<?php

namespace App\Providers;

use App\Listeners\Organization\OrganizationSubscriber;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        // Organization Related
        OrganizationSubscriber::class,
    ];
}
