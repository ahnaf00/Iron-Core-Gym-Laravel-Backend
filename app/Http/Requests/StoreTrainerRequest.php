<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTrainerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|unique:trainers,email',
            'phone'            => 'nullable|string|max:20',
            'specialty'        => 'required|string|max:255',
            'bio'              => 'nullable|string',
            'experience_years' => 'required|integer|min:0',
            'is_active'        => 'boolean',
            'photo'            => 'nullable|image|mimes:jpeg,png,webp|max:2048',
        ];
    }
}
