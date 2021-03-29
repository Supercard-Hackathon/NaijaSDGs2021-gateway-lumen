<?php

namespace App\Http\Controllers\Group;

use App\Repositories\Interfaces\GroupInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Validator;

class GroupController extends Controller
{
    /**
     * telling the class to inherit ApiResponse Trait
     */
    use ApiResponse;

    /**
     * declaration of Group repository
     *
     * @var groupRepository
     */
    private $groupRepository;

    /**
     * Dependency Injection of groupRepository.
     *
     * @param  \App\Repositories\Interfaces\GroupInterface  $groupRepository
     * @return void
     */
    public function __construct(GroupInterface $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    /**
     * create a new Group.
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Traits\ApiResponse
     */
    public function newGroup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'organization_id' => 'required|integer',
            'name' => 'required',
        ]);

        if($validator->fails()){
            return $this->errorResponseWithDetails('validation failed', $validator->errors(), 400);
        }

        return $this->successResponseForGateway($this->groupRepository->newGroup($request));
    }
}