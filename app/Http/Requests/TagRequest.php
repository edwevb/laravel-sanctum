<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $slug = '';
        if (Request::isMethod('PUT' || 'PATCH')) {
            $slug = Str::slug($this->title ?? $this->tag->title);
        } else {
            $slug = Str::slug($this->title);
        }
        $this->merge([
            'slug' => $slug
        ]);
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:100',
            'slug' => 'nullable|string'
        ];
    }
}
