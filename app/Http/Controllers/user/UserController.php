<?php

namespace App\Http\Controllers\user;

use App\Repositories\Interfaces\UserInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Validator;

class UserController extends Controller
{
    /**
     * telling the class to inherit ApiResponse Trait
     */
    use ApiResponse;

    /**
     * declaration of user repository
     *
     * @var userRepository
     */
    private $userRepository;

    /**
     * Dependency Injection of userRepository.
     *
     * @param  \App\Repositories\Interfaces\UserInterface  $userRepository
     * @return void
     */
    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Register a new user.
     * - validate incoming request
     * - if validator fails, return an error response using apiResponse trait
     * - if user email already exists, return an error response using apiResponse trait
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Traits\ApiResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'last_name' => 'required',
            'first_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'min:3|unique:users,username',
            'password' => 'required|confirmed'
        ]);

        if($validator->fails()){
            return $this->errorResponseWithDetails('validation failed', $validator->errors(), 400);
        }

        return $this->successResponseForGateway($this->userRepository->register($request));
    }

    /**
     * Login user.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Traits\ApiResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identifier' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return $this->errorResponseWithDetails('validation failed', $validator->errors(), 400);
        }

        $result = $this->userRepository->login($request);

        if ($result['status'] && $result['status'] == 'error') {
            unset($result['status']);
            return $this->errorResponseWithDetails('login failed', $result, 400);
        }

        unset($result['status']);

        return $this->successResponseForGateway($result);
    }

    /**
     * get user using Token
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Traits\ApiResponse
     */
    public function getUserByToken(Request $request)
    {
        return $this->successResponseForGateway($this->userRepository->getUserByToken($request));
    }

    /**
     * get user using Id
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Traits\ApiResponse
     */
    public function getUserById(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'organization_id' => 'required',
            'branch_id' => 'required',
            'user_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->errorResponseWithDetails('validation failed', $validator->errors(), 400);
        }

        return $this->successResponseForGateway($this->userRepository->getUserById($request->user_id));
    }

    /**
     * get Users by filters
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Traits\ApiResponse
     */
    public function getUsers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'organization_id' => 'required',
            'branch_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->errorResponseWithDetails('validation failed', $validator->errors(), 400);
        }

        return $this->successResponseForGateway($this->userRepository->getUsers($request));
    }
}
