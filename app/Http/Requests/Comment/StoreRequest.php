<?php

namespace App\Http\Requests\Comment;

use App\Http\Requests\GeneralRequest;

/**
 * @OA\Post(
 *   path="/api/comment",
 *   description="Add comment",
 *   tags={"comment"},
 *   security={{"sanctum":{}}},
 *   @OA\RequestBody(
 *     required=true,
 *     description="Add comment",
 *     @OA\JsonContent(
 *       required={"description","star","serviceId"},
 *       @OA\Property(property="description", type="string"),
 *       @OA\Property(property="star", type="integer"),
 *       @OA\Property(property="serviceId", type="integer"),
 *     ),
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Add comment"
 *   ),
 * )
 */
class StoreRequest extends GeneralRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'description' => 'required|string|min:3|max:255',
            'star' => 'required|integer|min:1|max:5',
            'serviceId' => 'required|integer|exists:services,id',
        ];
    }
}
