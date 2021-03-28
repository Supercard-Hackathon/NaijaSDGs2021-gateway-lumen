<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UserInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Organization;

class UserRepository implements UserInterface
{
	/**
     * Register a new user.
     * - Strip names to lowercase
     * - Persist incoming request to db
     * - generate access token
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function register(Request $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make(strtolower($input['password']));

        // strip some variables to lowercase
        $request->first_name? $input['first_name'] = strtolower($input['first_name']): null ;
        $request->last_name? $input['last_name'] = strtolower($input['last_name']): null ;
        $request->middle_name? $input['middle_name'] = strtolower($input['middle_name']): null ;
        $request->email? $input['email'] = strtolower($input['email']): null ;
        $request->username? $input['username'] = strtolower($input['username']): null ;

        // persist incoming request to db
		$user = User::create($input);
      
        // access token is generated here
        $data['token'] =  $user->createToken('Medispark EMR')->accessToken;
        $data['user'] = $this->getUserById($user->id);

        // Return response
        return $data;
    }
    
    /**
     * Login user.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function login(Request $request)
    {
        // find user via identifier
        $user = User::where([
                ['email', '=', $request->identifier]
            ])->orWhere([
                ['username', '=', $request->identifier]
            ])->first();

        if ($user == null) {
            $data["status"] = "error";
            $data["message"] = "can not find user, check your email or username again";
            return $data;
        }

        if (!Hash::check($request->password, $user->password)) {
            $data["status"] = "error";
            $data["message"] = "incorrect password";
            return $data;
        }

        $roles = $user->getRoleNames();
        $access_token = $user->createToken('authToken')->accessToken;
        $data['status'] = "success";
        // remove roles collection from user model
        unset($user['roles']);
        $data['user'] = $user;
        $data['user']['roles'] = $roles;
        $data['access_token'] = $access_token;

        // Return response
        return $data;
    }

    /**
     * attach roles to user
     *
     * @param  int  $user_id
     * @param  array  $roles
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function addUserRoles($user_id, $roles, $request)
    {
        // get user instance
        $user = $this->getUserById($user_id);

        // attach roles if any
        $request->filled('roles')? $user->assignRole($roles): null;   
    }

    /**
     * Get User using ID
     *
     * @param  int $user_id
     * @return array
     */
    public function getUserById($user_id)
    {
        return User::findOrFail($user_id);
    }

    /**
     * Get User using token
     *
     * @param  int $user_id
     * @return array
     */
    public function getUserByToken(Request $request)
    {
        $user = $request->user();

        $this->addRolesToUserModel($user);

        return $user;
    }

    /**
     * add user's role to the model
     *
     * @param  App\Models\user $user
     * @return array
     */
    public function addRolesToUserModel(User $user)
    {
        $roles = $user->getRoleNames();

        // remove roles collection from user model
        unset($user['roles']);

        // add roles array to the user model
        $user['roles'] = $roles;

        return $user;
    }

    /**
     * Get Users by filters
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Models\User
     */
    public function getUsers(Request $request)
    {
        $result = User::filter($request->all())->get()->all();
        
        return $result;
    }
}