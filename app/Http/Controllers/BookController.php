<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin')->except(['index']);
    }

    /**
     * @OA\Get(
     *     path="/api/books",
     *     tags={"Books"},
     *     summary="Get list of all books",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="List of books")
     * )
     */

    public function index()
    {
        return Book::all();
    }

    /**
     * @OA\Post(
     *     path="/api/books",
     *     tags={"Books"},
     *     summary="Create a new book (admin only)",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title","photo","price","description"},
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="photo", type="string", description="URL or path to book photo"),
     *             @OA\Property(property="price", type="number", format="float"),
     *             @OA\Property(property="description", type="string")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Book created"),
     *     @OA\Response(response=403, description="Forbidden")
     * )
     */

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'photo' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ]);

        $book = Book::create($data);

        return response()->json($book, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/books/{id}",
     *     tags={"Books"},
     *     summary="Update a book (admin only)",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="photo", type="string"),
     *             @OA\Property(property="price", type="number", format="float"),
     *             @OA\Property(property="description", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Book updated"),
     *     @OA\Response(response=404, description="Book not found"),
     *     @OA\Response(response=403, description="Forbidden")
     * )
     */

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $data = $request->validate([
            'title' => 'string',
            'photo' => 'string',
            'price' => 'numeric',
            'description' => 'string',
        ]);
        
        $book->update($data);

        return response()->json($book);
    }

    /**
     * @OA\Delete(
     *     path="/api/books/{id}",
     *     tags={"Books"},
     *     summary="Delete a book (admin only)",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=204, description="Book deleted"),
     *     @OA\Response(response=404, description="Book not found"),
     *     @OA\Response(response=403, description="Forbidden")
     * )
     */

    public function destroy($id)
    {
        Book::destroy($id);
        return response()->json(null, 204);
    }
}
