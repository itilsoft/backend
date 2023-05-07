<?php

namespace App\Http\Requests\User;

use App\Http\Requests\GeneralRequest;

/**
 * @OA\Post(
 *   path="/api/user/login",
 *   description="Login",
 *   tags={"user"},
 *   @OA\RequestBody(
 *     required=true,
 *     description="Login",
 *     @OA\JsonContent(
 *       required={"username","password"},
 *       @OA\Property(property="username", type="string"),
 *       @OA\Property(property="password", type="string", format="password"),
 *     ),
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Login"
 *   ),
 * )
 */
class LoginRequest extends GeneralRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|min:3|max:20',
            'password' => 'required|string|min:6|max:20',
        ];
    }
}
