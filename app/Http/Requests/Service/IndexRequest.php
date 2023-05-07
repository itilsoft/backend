<?php

namespace App\Http\Requests\Service;

use App\Http\Requests\GeneralRequest;

/**
 * @OA\Get(
 *   path="/api/service",
 *   description="Get Services",
 *   tags={"service"},
 *   security={{"sanctum":{}}},
 *   @OA\Response(
 *     response=200,
 *     description="Get Services"
 *   ),
 * )
 */
class IndexRequest extends GeneralRequest
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
