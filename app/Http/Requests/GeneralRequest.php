<?php

namespace App\Http\Requests;

use App\Http\Resources\Resource;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class GeneralRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw (new HttpResponseException(response()->json(
            (new Resource(false, $validator->messages()->all()))->response()
        )));
    }
}
