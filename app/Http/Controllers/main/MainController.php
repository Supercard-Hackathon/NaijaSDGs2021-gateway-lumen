<?php

namespace App\Http\Controllers\main;

use App\Repositories\Interfaces\MainInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Validator;

class MainController extends Controller
{
    /**
     * telling the class to inherit ApiResponse Trait
     */
    use ApiResponse;

    /**
     * declaration of main repository
     *
     * @var mainRepository
     */
    private $mainRepository;

    /**
     * Dependency Injection of mainRepository.
     *
     * @param  \App\Repositories\Interfaces\MainInterface  $mainRepository
     * @return void
     */
    public function __construct(MainInterface $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    /**
     * Check if Index works.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Traits\ApiResponse
     */
    public function test(Request $request)
    {
        return $this->successResponseForGateway($this->mainRepository->test($request));
    }
}
