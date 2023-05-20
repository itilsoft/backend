<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\GetUserRequest;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\LogoutRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\Resource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::query()->where('username', $request->username)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                return (new Resource(true))->response([
                    'token' => $user->createToken('itilsoft')->plainTextToken,
                    'user' => $user,
                ]);
            }
        }

        return (new Resource(false, ['Kullanıcı adı veya şifre hatalı.']))->response();
    }

    public function register(RegisterRequest $request)
    {
        $user = new User();
        $user->fullname = $request->fullname;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();

        return (new Resource(true))->response();
    }

    public function getUser(GetUserRequest $request)
    {
        $userId = $request->user()->id;
        $user = User::with('comments.service')->find($userId);

        return (new Resource(true))->response(['user' => $user]);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = $request->user();
        if (Hash::check($request->oldPassword, $user->password)) {
            $user->password = Hash::make($request->newPassword);
            $user->save();

            return (new Resource(true))->response();
        }

        return (new Resource(false, ['Eski şifre yanlış.']))->response();
    }

    public function logout(LogoutRequest $request)
    {
        $request->user()->currentAccessToken()->delete();
        return (new Resource(true))->response();
    }
}
