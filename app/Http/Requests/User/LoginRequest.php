<?php

namespace App\Http\Requests\User;

use App\Http\Resources\Resource;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
class LoginRequest extends FormRequest
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

    protected function failedValidation(Validator $validator)
    {
        throw (new HttpResponseException(response()->json(
            (new Resource(false, $validator->messages()->all()))->response()
        )));
    }
}
