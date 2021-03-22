<?php

namespace App\Repositories;

use App\Repositories\Interfaces\MainInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use Illuminate\Http\Request;

class MainRepository implements MainInterface
{
	/**
     * test that the index works
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function test(Request $request)
    {
        return "supercard to the moon";
    }
}