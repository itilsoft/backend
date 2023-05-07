<?php

namespace App\Http\Requests\User;

use App\Http\Resources\Resource;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
 *       required={"old_password","new_password"},
 *       @OA\Property(property="old_password", type="string", format="password"),
 *       @OA\Property(property="new_password", type="string", format="password"),
 *     ),
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Change Password"
 *   ),
 * )
 */
class ChangePasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'old_password' => 'required|string|min:6|max:20',
            'new_password' => 'required|string|min:6|max:20',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw (new HttpResponseException(response()->json(
            (new Resource(false, $validator->messages()->all()))->response()
        )));
    }
}
