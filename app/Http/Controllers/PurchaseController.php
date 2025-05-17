<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\PurchaseRequest;

class PurchaseController extends Controller
{

    /**
     * @OA\Post(
     *     path="/api/purchase/{bookId}",
     *     tags={"Purchase"},
     *     summary="Purchase a book with card payment simulation",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="bookId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"card_number"},
     *             @OA\Property(property="card_number", type="string", description="Credit card number")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Payment successful, book purchased"),
     *     @OA\Response(response=402, description="Payment failed"),
     *     @OA\Response(response=403, description="User banned"),
     *     @OA\Response(response=404, description="Book not found")
     * )
     */

     public function purchase(PurchaseRequest $request, $bookId)
    {
        $user = auth()->user();

        if ($user->is_banned) {
            return response()->json(['error' => 'User banned'], 403);
        }

        $book = Book::findOrFail($bookId);

        $cardNumber = $data['card_number'];

        if ($cardNumber % 2 === 0) {
            return response()->json(['message' => 'Payment successful, book purchased']);
        }

        return response()->json(['message' => 'Payment failed'], 402);
    }
}
