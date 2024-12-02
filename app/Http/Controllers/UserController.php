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
}
