<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function show(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'User data retrieved successfully',
            'data' => $request->user(),
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|min:3|max:255',
            'email' => 'sometimes|email|max:255|unique:users,email,' . $request->user()->id,
        ]);

        $request->user()->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'User data updated successfully',
            'data' => $request->user(),
        ]);
    }

    public function updatePassword(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'current_password'      => 'required',
            'new_password'          => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'confirmed',
            ],
        ]);

        $user = $request->user();

        if (!Hash::check($validated['current_password'], $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password saat ini salah.',
            ], 400);
        }

        $user->password = Hash::make($validated['new_password']);
        $user->save();

        $user->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Password berhasil diperbarui.',
        ]);
    }
}
