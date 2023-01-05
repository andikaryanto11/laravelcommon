<?php

namespace LaravelCommon\App\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelCommon\App\Repositories\UserRepository;
use LaravelCommon\Responses\PagedJsonResponse;
use LaravelCommon\System\Http\Request as HttpRequest;

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

    public function getAll(HttpRequest $request)
    {
        $users = $this->userRepository;

        return new PagedJsonResponse('OK', [], $users);
    }
}
