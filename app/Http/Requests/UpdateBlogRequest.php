<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'        => 'sometimes|required|string|max:255',
            'content'      => 'sometimes|required|string',
            'excerpt'      => 'nullable|string|max:500',
            'category'     => 'nullable|string|max:100',
            'tags'         => 'nullable|array',
            'tags.*'       => 'string',
            'is_published' => 'boolean',
            'thumbnail'    => 'nullable|image|mimes:jpeg,png,webp|max:2048',
        ];
    }
}
