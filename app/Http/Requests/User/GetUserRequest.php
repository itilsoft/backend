<?php

namespace App\Http\Requests\User;

use App\Http\Requests\GeneralRequest;

/**
 * @OA\Get(
 *   path="/api/user",
 *   description="Get User Info",
 *   tags={"user"},
 *   security={{"sanctum":{}}},
 *   @OA\Response(
 *     response=200,
 *     description="Get User Info"
 *   ),
 * )
 */
class GetUserRequest extends GeneralRequest
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
