<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required',
            'password' => 'required'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data' => $validator->errors()
        ], 422);
        throw new HttpResponseException($response);
    }
}
