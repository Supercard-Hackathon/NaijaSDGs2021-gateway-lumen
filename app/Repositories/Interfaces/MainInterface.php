<?php

namespace App\Repositories\Interfaces;
use Illuminate\Http\Request;

interface MainInterface
{
    public function test(Request $request);
}