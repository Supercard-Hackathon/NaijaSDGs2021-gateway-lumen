<?php

namespace App\Listeners\Organization;

use App\Listeners\Organization\OrganizationSubscriber;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Repositories\Interfaces\OrganizationInterface;

class OrganizationSubscriber
{
    /**
     * private declaration of repositories
     *
     * @var organizationRepository
     */
    private $organizationRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(OrganizationInterface $organizationRepository)
    {
        $this->organizationRepository = $organizationRepository;
    }

    /**
     * Handle event.
     */
    public function addUserToOrganization($event) 
    {
        $this->organizationRepository->addUserToOrganization($event->user->id, $event->organization->id);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\Organization\NewOrganizationCreatedEvent',
            [OrganizationSubscriber::class, 'addUserToOrganization']
        );
    }
}
