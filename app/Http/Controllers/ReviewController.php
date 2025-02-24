<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::all();

        return response()->json([
            'status' => 200,
            'message' => 'Reviews retrieved successfully.',
            'data' => $reviews
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|integer',
            'user_id' => 'required|integer',
            'rating' => 'required|integer',
            'comment' => 'required|string'
        ]);

        $review = Review::create($request->all());

        return response()->json([
            'status' => 201,
            'message' => 'Review created successfully.',
            'data' => $review
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json([
                'status' => 404,
                'message' => 'Review not found.',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Review retrieved successfully.',
            'data' => $review
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'book_id' => 'required|integer',
            'user_id' => 'required|integer',
            'rating' => 'required|integer',
            'comment' => 'required|string'
        ]);

        $review = Review::find($id);

        if (!$review) {
            return response()->json([
                'status' => 404,
                'message' => 'Review not found.',
            ], 404);
        }

        $review->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Review updated successfully.',
            'data' => $review
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $review = Review::find($id);

        if (!$review) {
            return response()->json([
                'status' => 404,
                'message' => 'Review not found.',
            ], 404);
        }

        $review->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Review deleted successfully.',
        ], 200);
    }
}
