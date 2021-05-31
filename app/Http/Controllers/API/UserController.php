<?php

namespace App\Http\Controllers\API;

use App\Clusters\UserControllerInterface;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Http\JsonResponse;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    /**
     * @var UserControllerInterface
     */
    private $userService;

    /**
     * CategoryController constructor.
     * @param UserControllerInterface $userService
     */
    public function __construct(
        UserControllerInterface $userService
    )
    {
        $this->userService = $userService;
    }


    /**
     * @param UserRegisterRequest $request
     * @return JsonResponse
     */
    public function register(UserRegisterRequest $request): JsonResponse
    {
       return $this->userService->register($request);
    }

    /**
     * @param UserLoginRequest $request
     * @return JsonResponse
     */
    public function login(UserLoginRequest $request): JsonResponse
    {
       return $this->userService->login($request);
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
       return $this->userService->logout();
    }
}
