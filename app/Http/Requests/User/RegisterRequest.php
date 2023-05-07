<?php

namespace App\Http\Requests\User;

use App\Http\Requests\GeneralRequest;

/**
 * @OA\Post(
 *   path="/api/user/register",
 *   description="Register",
 *   tags={"user"},
 *   @OA\RequestBody(
 *     required=true,
 *     description="Register",
 *     @OA\JsonContent(
 *       required={"fullname", "username","password"},
 *       @OA\Property(property="fullname", type="string"),
 *       @OA\Property(property="username", type="string"),
 *       @OA\Property(property="password", type="string", format="password"),
 *     ),
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Register"
 *   ),
 * )
 */
class RegisterRequest extends GeneralRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'fullname' => 'required|string|min:3|max:30',
            'username' => 'required|string|unique:users|min:3|max:20',
            'password' => 'required|string|min:6|max:20',
        ];
    }
}
