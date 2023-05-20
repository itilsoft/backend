<?php

namespace App\Http\Requests\User;

use App\Http\Requests\GeneralRequest;

/**
 * @OA\Post(
 *   path="/api/user/logout",
 *   description="User Logout",
 *   tags={"user"},
 *   security={{"sanctum":{}}},
 *   @OA\Response(
 *     response=200,
 *     description="User Logout"
 *   ),
 * )
 */
class LogoutRequest extends GeneralRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [

        ];
    }
}
