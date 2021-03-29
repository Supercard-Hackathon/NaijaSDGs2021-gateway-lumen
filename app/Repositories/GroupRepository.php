<?php

namespace App\Repositories;

use App\Repositories\Interfaces\GroupInterface;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;
use Auth;

class GroupRepository implements GroupInterface
{

    /**
     * create new Group
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function newGroup(Request $request)
    {
        return 'got to new Group page';  
    }

    /**
     * Get Group using id
     * @param  int $group_id
     * @return App\Model\Group
     */
    public function getGroupById($group_id)
    {
        return Group::findOrFail($group_id);
    }

    /**
     * attach user to a Group
     * @param  int  $user_id
     * @param  int  $group_id
     * @return void
     */
    public function addUserToGroup($user_id, $group_id)
    {
        // get Group
        $group = $this->getGroupById($group_id);

        // get user
        $user = User::findOrFail($user_id);

        // attach user to Group
        $group->users()->save($user);  
    }
}