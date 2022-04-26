<?php

namespace App\Http\Requests;

use App\Entities\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseFormRequest extends FormRequest
{
    /**
     * Override the default failed validation handler
     *
     * @param Illuminate\Contracts\Validation\Validator $validator
     */
    final protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        $response = (new ApiResponse())->badRequest($errors);
        throw new HttpResponseException($response);
    }
}
