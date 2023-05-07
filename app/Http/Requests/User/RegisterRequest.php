<?php

namespace App\Http\Requests\User;

use App\Http\Resources\Resource;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * @OA\Post(
 *   path="/api/user/register",
 *   description="Register",
 *   tags={"user"},
 *   @OA\RequestBody(
 *     required=true,
 *     description="Register",
 *     @OA\JsonContent(
 *       required={"full_name", "username","password"},
 *       @OA\Property(property="full_name", type="string"),
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
class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|min:3|max:30',
            'username' => 'required|string|unique:users|min:3|max:20',
            'password' => 'required|string|min:6|max:20',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw (new HttpResponseException(response()->json(
            (new Resource(false, $validator->messages()->all()))->response()
        )));
    }
}
