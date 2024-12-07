<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdatePasswordRequest;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Http\Resources\ApiResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

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
            return new ApiResource(false, "Validation Failed!", null);
        }

        $user->password = $data['new_password'];
        $user->save();

        $user->tokens()->delete();

        return new ApiResource(true, 'Password Updated!', null);
    }

    public function updatePhotoProfile(Request $request)
    {
        try {
            $user = $request->user();
            if (!$request->hasFile('picture')) {
                return new ApiResource(false, 'No picture file received!', null);
            }

            $file = $request->file('picture');

            $rules = [
                'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return new ApiResource(false, $validator->errors()->first(), null);
            }

            $path = $file->store('profile_pictures', 'public');
            $user->profile_picture = $path;
            $user->save();

            return new ApiResource(true, "Profile picture updated!", $user);
        } catch (Exception $e) {
            Log::error("Error updating profile picture: " . $e->getMessage());
            return new ApiResource(false, 'Failed to update profile picture!', null);
        }
    }
}
