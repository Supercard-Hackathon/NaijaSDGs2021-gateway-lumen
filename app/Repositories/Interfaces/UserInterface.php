<?php

namespace App\Repositories\Interfaces;
use Illuminate\Http\Request;
use App\Models\User;

interface UserInterface
{
    public function register(Request $request);

    public function login(Request $request);

    public function getUserById($user_id);

    public function getUserByToken(Request $request);

    public function getUsers(Request $request);
}