<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return response()->json([
            'status' => 200,
            'message' => 'Users retrieved successfully.',
            'data' => $users
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string'
        ]);

        $user = User::create($request->all());

        return response()->json([
            'status' => 201,
            'message' => 'User created successfully.',
            'data' => $user
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found.',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'User retrieved successfully.',
            'data' => $user
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string'
        ]);

        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found.',
            ], 404);
        }

        $user->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'User updated successfully.',
            'data' => $user
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found.',
            ], 404);
        }

        $user->delete();

        return response()->json([
            'status' => 200,
            'message' => 'User deleted successfully.',
        ], 200);
    }
}
