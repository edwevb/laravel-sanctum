<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

    public function authorize(): bool
    {
        return false;
    }


    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'username' => 'required|string',
            'email' => 'required',
            'password' => 'required',
        ];
    }
}
