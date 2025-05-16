<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin');
    }

    /**
     * @OA\Post(
     *     path="/api/admin/ban/{userId}",
     *     tags={"Admin"},
     *     summary="Ban a user (admin only)",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="userId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="User banned"),
     *     @OA\Response(response=403, description="Forbidden"),
     *     @OA\Response(response=404, description="User not found")
     * )
     */

    public function banUser(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $user->is_banned = true;
        $user->save();

        return response()->json(['message' => 'User banned']);
    }

    /**
     * @OA\Get(
     *     path="/api/admin/stats",
     *     tags={"Admin"},
     *     summary="Get admin statistics",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Statistics data"),
     *     @OA\Response(response=403, description="Forbidden")
     * )
     */

    public function stats()
    {
        $usersCount = User::count();
        $bannedCount = User::where('is_banned', true)->count();
        $booksCount = Book::count();

        return response()->json([
            'users_count' => $usersCount,
            'banned_users' => $bannedCount,
            'books_count' => $booksCount,
        ]);
    }
}
