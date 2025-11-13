<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class ReviewController extends Controller
{
    public function summary(): JsonResponse
    {
        return response()->json([
            'rating' => 4.5,
            'reviews_total' => 123,
        ]);
    }

    public function index(): JsonResponse
    {
        return response()->json([
            ['id' => 1, 'author' => 'John Doe', 'rating' => 5, 'date' => '2024-01-01', 'text' => 'Great service!'],
            ['id' => 2, 'author' => 'Jane Smith', 'rating' => 4, 'date' => '2024-01-05', 'text' => 'Good experience overall.'],
            ['id' => 3, 'author' => 'Mike Johnson', 'rating' => 5, 'date' => '2024-02-10', 'text' => 'Absolutely loved it!'],
            ['id' => 4, 'author' => 'Anna Brown', 'rating' => 3, 'date' => '2024-02-20', 'text' => 'Could be better, but satisfied.'],
            ['id' => 5, 'author' => 'Alex Green', 'rating' => 4, 'date' => '2024-03-01', 'text' => 'Friendly staff and quick service.'],
            ['id' => 6, 'author' => 'Emily Wilson', 'rating' => 5, 'date' => '2024-03-10', 'text' => 'Highly recommend to everyone!'],
        ]);
    }
}
