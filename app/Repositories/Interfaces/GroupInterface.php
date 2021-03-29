<?php

namespace App\Repositories\Interfaces;
use Illuminate\Http\Request;
use App\Models\Group;

interface GroupInterface
{
    public function newGroup(Request $request);

    public function getGroupById($group_id);

    public function addUserToGroup($user_id, $group_id);
}