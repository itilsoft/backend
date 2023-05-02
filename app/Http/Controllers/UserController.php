<?php

namespace App\Http\Controllers;

use App\Http\Resources\Resource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|min:3|max:20',
            'password' => 'required|string|min:6|max:20',
        ]);
        if ($validator->fails()) {
            return (new Resource(false, $validator->messages()->all()))->response();
        }

        $user = User::query()->where('username', $request->username)->first();
        if($user) {
            if(Hash::check($request->password, $user->password)) {
                return (new Resource(true))->response([
                    'token' => $user->createToken('itilsoft')
                ]);
            }
        }

        return (new Resource(false, ['Kullanıcı adı veya şifre hatalı.']))->response();
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|min:3|max:30',
            'username' => 'required|string|min:3|max:20',
            'password' => 'required|string|min:6|max:20',
        ]);
        if ($validator->fails()) {
            return (new Resource(false, $validator->messages()->all()))->response();
        }

        $user = new User();
        $user->full_name = $request->full_name;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();

        return (new Resource(true))->response();
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string|min:6|max:20',
            'new_password' => 'required|string|min:6|max:20',
        ]);
        if ($validator->fails()) {
            return (new Resource(false, $validator->messages()->all()))->response();
        }

        $user = $request->user();
        if(Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();

            return (new Resource(true))->response();
        }

        return (new Resource(false, ['Eski şifre yanlış.']))->response();
    }
}
