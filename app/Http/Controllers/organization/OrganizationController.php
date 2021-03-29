<?php

namespace App\Http\Controllers\organization;

use App\Repositories\Interfaces\OrganizationInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Validator;

class OrganizationController extends Controller
{
    /**
     * telling the class to inherit ApiResponse Trait
     */
    use ApiResponse;

    /**
     * declaration of Organization repository
     *
     * @var organizationRepository
     */
    private $organizationRepository;

    /**
     * Dependency Injection of organizationRepository.
     *
     * @param  \App\Repositories\Interfaces\OrganizationInterface  $organizationRepository
     * @return void
     */
    public function __construct(OrganizationInterface $organizationRepository)
    {
        $this->organizationRepository = $organizationRepository;
    }

    /**
     * get details of the organization.
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Traits\ApiResponse
     */
    public function getDetails(Request $request)
    {
        return $this->successResponseForGateway($this->organizationRepository->getDetails($request));
    }

    /**
     * create a new organization.
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Traits\ApiResponse
     */
    public function newOrganization(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'street' => 'required',
            'city' => 'required',
            'state' => 'required',
            'email' => 'required|unique:organizations,email',
            'website' => 'required',
            'phone' => 'required',
        ]);

        if($validator->fails()){
            return $this->errorResponseWithDetails('validation failed', $validator->errors(), 400);
        }

        return $this->successResponseForGateway($this->organizationRepository->newOrganization($request));
    }
}