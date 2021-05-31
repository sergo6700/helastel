<?php


namespace App\Clusters;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface UserControllerInterface
{

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse;

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse;
}
