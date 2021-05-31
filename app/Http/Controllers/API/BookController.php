<?php

namespace App\Http\Controllers\API;

use App\Clusters\BookControllerInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{

    /**
     * @var BookControllerInterface
     */
    private $bookService;

    /**
     * CategoryController constructor.
     * @param BookControllerInterface $bookService
     */
    public function __construct(
        BookControllerInterface $bookService
    )
    {
        $this->bookService = $bookService;
    }

    /**
     * @return array
     */
    public function index(): array
    {
        return $this->bookService->index();
    }

    /**
     * @param BookRequest $request
     * @return JsonResponse
     */
    public function add(BookRequest $request): JsonResponse
    {
        return $this->bookService->add($request);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function edit($id): JsonResponse
    {
        return $this->bookService->edit($id);
    }

    /**
     * @param $id
     * @param BookRequest $request
     * @return JsonResponse
     */
    public function update($id, BookRequest $request): JsonResponse
    {
        return $this->bookService->update($id,$request);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        return $this->bookService->delete($id);
    }

}
