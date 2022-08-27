<?php

namespace LaravelCommon\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use LaravelCommon\App\Repositories\UserRepository;
use LaravelCommon\App\Services\UserService;
use LaravelCommon\App\ViewModels\User\TokenViewModel;
use LaravelCommon\App\ViewModels\UserCollection;
use LaravelCommon\Responses\SuccessResponse;

class UserController extends Controller
{
    /**
     * Undocumented variable
     *
     * @var UserRepository
     */
    protected UserRepository $userRepository;

    /**
     * Undocumented function
     *
     * @param UserRepository $userRepository
     */
    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function getAll(Request $request)
    {
        $users = $this->userRepository->gather();

        return new SuccessResponse('OK', [], $users);
    }
}
