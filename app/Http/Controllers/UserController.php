<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdatePasswordRequest;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Http\Resources\ApiResource;
use Exception;
use Illuminate\Http\Request;

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

    public function update(UpdateProfileRequest $request)
    {
        try {
            $request->user()->update($request->getData());

            return new ApiResource(true, "User Data Updated!", $request->user());
        } catch (Exception $e) {
            Log::info("message error log update user: " + $e);
            return new ApiResource(false, 'User Data Update Failed!', null);
        }
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = $request->user();

        $data = $request->getData();

        if (!Hash::check($data['current_password'], $user->password)) {
            return new ApiResource(false,"Validation Failed!",null);
        }

        $user->password = $data['new_password'];
        $user->save();

        $user->tokens()->delete();

        return new ApiResource(true,'Password Updated!', null);
    }

    public function updatePassword(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'current_password' => 'required|string',
            'new_password' => [
                'required',
                'string',
                'min:8',              // Minimum 8 characters
                'confirmed',          // Must match the new_password_confirmation field
            ],
        ]);

        $user = $request->user();

        // Check if the provided current password matches the stored password
        if (!Hash::check($validated['current_password'], $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password saat ini salah.', // "Current password is incorrect."
            ], 400); // Bad Request
        }

        // Update the user's password
        $user->password = Hash::make($validated['new_password']);
        $user->save();

        // Optional: Invalidate all existing tokens to ensure security
        // This forces the user to log in again with the new password
        // If you're using Laravel Sanctum or Passport, adjust accordingly
        // Example for Laravel Sanctum:
        // $user->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Password berhasil diperbarui.', // "Password updated successfully."
        ], 200); // OK
    }
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
