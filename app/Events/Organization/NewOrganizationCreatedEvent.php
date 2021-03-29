<?php

namespace App\Events\Organization;

use App\Events\Event;
use Illuminate\Http\Request;
use App\Models\Organization;
use Auth;

class NewOrganizationCreatedEvent extends Event
{

    /**
     * Public declareation of variables.
     *
     * @var \Illuminate\Http\Request $request
     * @var  \App\Models\Organization $organization
     */
    public $request;
    public $organization;
    public $user;

    /**
     * Dependency Injection of variables
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Organization $organization
     * @return void
     */
    public function __construct(Request $request, Organization $organization)
    {
        $this->request = $request;
        $this->organization = $organization;
        $this->user = Auth::user();
    }
}
