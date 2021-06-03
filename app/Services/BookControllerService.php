<?php


namespace App\Services;

use App\Clusters\BookControllerInterface;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookControllerService implements BookControllerInterface
{

    /**
     * @var Book
     */
    private $book;

    /**
     * UserControllerService constructor.
     */
    public function __construct()
    {
        $this->book = new Book();
    }

    /**
     * @return array
     */
    public function index(): array
    {
        $books = $this->book->where('user_id', Auth::id())->get()->toArray();
        return array_reverse($books);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function add(Request $request): JsonResponse
    {

        try {
            $this->book->create([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'user_id' => Auth::id()
            ]);
            $success = true;
            $message = 'Contact added successfully!';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = "Contact name already exist!";
        }

        $response = [
            'success' => $success,
            'message' => $message,
        ];

        return response()->json($response);

    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function edit($id): JsonResponse
    {
        $book = $this->book->find($id);
        return response()->json($book);
    }

    /**
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update($id, Request $request): JsonResponse
    {
        $book = $this->book->find($id);
        if ($book) {
            try {
                $book->update($request->all());
                $success = true;
                $message = 'Contact updated successfully!';
            } catch (\Illuminate\Database\QueryException $ex) {
                $success = false;
                $message = "Contact name already exist!";
            }
        } else {
            $success = false;
            $message = "Something went wrong!";
        }

        $response = [
            'success' => $success,
            'message' => $message,
        ];

        return response()->json($response);

    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        $book = $this->book->find($id);
        if ($book) {
            $book->delete();
            $success = true;
            $message = 'Contact deleted successfully!';
        } else {
            $success = false;
            $message = "Something went wrong!";
        }

        $response = [
            'success' => $success,
            'message' => $message,
        ];

        return response()->json($response);
    }
}
