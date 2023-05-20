<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\GeneralRequest;

/**
 * @OA\Get(
 *   path="/api/admin/statistics",
 *   description="Get Statistics",
 *   tags={"admin"},
 *   security={{"sanctum":{}}},
 *   @OA\Response(
 *     response=200,
 *     description="Get Statistics"
 *   ),
 * )
 */
class GetStatisticsRequest extends GeneralRequest
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
