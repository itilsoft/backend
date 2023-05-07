<?php

namespace App\Http\Requests\User;

use App\Http\Requests\GeneralRequest;

/**
 * @OA\Post(
 *   path="/api/user/change-password",
 *   description="Change Password",
 *   tags={"user"},
 *   security={{"sanctum":{}}},
 *   @OA\RequestBody(
 *     required=true,
 *     description="Change Password",
 *     @OA\JsonContent(
 *       required={"oldPassword","newPassword"},
 *       @OA\Property(property="oldPassword", type="string", format="password"),
 *       @OA\Property(property="newPassword", type="string", format="password"),
 *     ),
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Change Password"
 *   ),
 * )
 */
class ChangePasswordRequest extends GeneralRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'oldPassword' => 'required|string|min:6|max:20',
            'newPassword' => 'required|string|min:6|max:20',
        ];
    }
}
