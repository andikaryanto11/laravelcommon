<?php

namespace LaravelCommon\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use LaravelCommon\App\Services\UserService;
use LaravelCommon\App\ViewModels\User\TokenViewModel;
use LaravelCommon\Responses\SuccessResponse;

class AuthController extends Controller {

    /**
     * @var UserService
     */
    protected UserService $userService;

    /**
     *
     * @param UserService $userService
     */
    public function __construct(
        UserService $userService
    )
    {
        $this->userService = $userService;
    }


    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function generateToken(Request $request){
        $username = $request->username;
        $password = $request->password;

        $userToken = $this->userService->generateToken($username, $password);
        return (new SuccessResponse('OK', [], new TokenViewModel($userToken)));
    }
}