<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UserInterface;
use App\Repositories\Interfaces\OrganizationInterface;
use App\Events\Organization\NewOrganizationCreatedEvent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Organization;
use App\Models\User;
use Auth;

class OrganizationRepository implements OrganizationInterface
{
    /**
     * private declaration of repositories
     *
     * @var userRepository
     */
    private $userRepository;

    /**
     * Dependency Injection of some repositories.
     *
     * @param  \App\Repositories\Interfaces\UserInterface  $userRepository
     * @return void
     */
    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * create new organization
     * @param  \Illuminate\Http\Request  $request
     * @return App\Models\Organization
     */
    public function newOrganization(Request $request)
    {
        // create new organization
        $new_organization = Organization::firstOrCreate([
                        "name" => $request->name,
                        "street" => $request->street,
                        "city" => $request->city,
                        "state" => $request->state,
                        "email" => $request->email,
                        "website" => $request->website,
                        "phone" => $request->phone,
                    ]);

        // call event that a new organization has been created
        event(new NewOrganizationCreatedEvent($request, $new_organization));

        return $new_organization;   
    }

    /**
   
     * Get User's organization details
     * @param  int $user_id
     * @return App\Models\Organization
     */
    public function getOrganizationByUserId($user_id)
    {
        return User::findOrFail($user_id)->organization;
    }

    /**
     * attach user to a organization
     * @param  int  $user_id
     * @param  int  $organization_id
     * @return void
     */
    public function addUserToOrganization($user_id, $organization_id)
    {
        // get organization
        $organization = $this->getOrganizationById($organization_id);

        // get user
        $user = $this->userRepository->getUserById($user_id);

        // sync user to the organization without removing previous users, also don't sync if its done before
        $organization->users()->save($user);   
    }

    /**
     * Get organization using ID
     * @param  int $organization_id
     * @return App\Models\Organization
     */
    public function getOrganizationById($organization_id)
    {
        return Organization::find($organization_id)->with("groups")->first();
    }

    /**
     * Get organization using slug
     * @param  int $organization_slug
     * @return App\Models\Organization
     */
    public function getOrganizationBySlug($organization_slug)
    {
        return Organization::where("slug", $organization_slug)->with("groups")->first();
    }

    /**
     * create new slug for the newly created organization
     *
     * @param \App\Models\Organization $new_organization
     * @return void
     */
    public function newSlugForNewOrganization(Organization $new_organization)
    {
        // make a slug and update new organization details
        $new_organization->slug = $this->makeSlug($new_organization->name);
        $new_organization->save();
    }

    /**
     * create slug for organization
     * @param  int $text
     * @return string
     */
    public function makeSlug($text)
    {
        $slug = Str::slug( substr($text, 0, 150) );

        $latestSlug = 
            Organization::whereRaw("slug RLIKE '^{$slug}(-[0-9]*)?$'")
                ->latest('id')
                ->pluck('slug')->first();

        if( $latestSlug ){
            $pieces = explode('-', $latestSlug);
            $number = intval(end($pieces));
            $slug.='-'.($number + 1);
        }  
        
        return $slug;
    }
}