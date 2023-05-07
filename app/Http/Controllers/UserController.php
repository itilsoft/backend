<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\Resource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::query()->where('username', $request->username)->first();
        if($user) {
            if(Hash::check($request->password, $user->password)) {
                return (new Resource(true))->response([
                    'token' => $user->createToken('itilsoft')->plainTextToken
                ]);
            }
        }

        return (new Resource(false, ['Kullanıcı adı veya şifre hatalı.']))->response();
    }

    public function register(RegisterRequest $request)
    {
        $user = new User();
        $user->full_name = $request->full_name;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();

        return (new Resource(true))->response();
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = $request->user();
        if(Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();

            return (new Resource(true))->response();
        }

        return (new Resource(false, ['Eski şifre yanlış.']))->response();
    }
}
