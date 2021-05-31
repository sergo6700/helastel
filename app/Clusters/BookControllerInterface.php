<?php


namespace App\Clusters;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface BookControllerInterface
{
    /**
     * @return array
     */
    public function index(): array;
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function add(Request $request): JsonResponse;
    /**
     * @param $id
     * @return JsonResponse
     */
    public function edit($id): JsonResponse;
    /**
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update($id, Request $request): JsonResponse;
    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse;
}
