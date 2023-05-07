<?php

namespace App\Http\Requests\Service;

use App\Http\Requests\GeneralRequest;

/**
 * @OA\Get(
 *   path="/api/service/{id}",
 *   description="Get Service By Id",
 *   tags={"service"},
 *   security={{"sanctum":{}}},
 *   @OA\Parameter(
 *     name="id",
 *     description="Service id",
 *     required=true,
 *     in="path",
 *     @OA\Schema(type="integer")
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Get Service  By Id"
 *   ),
 * )
 */
class ShowRequest extends GeneralRequest
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
