<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->title ?? $this->post->title),
        ]);
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:100',
            'slug' => 'nullable',
            'description' => 'required|string',
            'image' => 'nullable', File::image()->types(['jpg', 'jpeg', 'JPG', 'png', 'webp'])->max(2048),
            'active' => 'nullable|numeric|max:1|size:1',
        ];
    }

    public function messages()
    {
        return [
            'active.size' => 'must not greater than 1',
            'active.max' => 'must be at least 1 size',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'message'   => 'Validation errors',
            'errors' => $validator->errors()
        ], 422);
        throw new HttpResponseException($response);
    }

    protected function passedValidation(): void
    {
        // $this->replace(['name' => 'Taylor']);
    }
}
