<?php

namespace LaravelCommon\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use LaravelCommon\App\Repositories\UserRepository;
use LaravelCommon\App\ViewModels\UserViewModel;
use LaravelCommon\Responses\JsonResponse;
use LaravelCommon\Responses\PagedJsonResponse;
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

    public function store(Request $request)
    {
        $user = $request->getResource();

        return new SuccessResponse('OK', [], new UserViewModel($user));
    }

    public function getAll(Request $request)
    {
        $users = $this->userRepository;

        return new PagedJsonResponse('OK', [], $users);
    }
}
