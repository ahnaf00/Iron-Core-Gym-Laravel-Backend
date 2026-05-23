<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMembershipPlanRequest extends FormRequest
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
            'name'            => 'required|string|max:255',
            'duration_months' => 'required|integer|min:1',
            'price'           => 'required|numeric|min:0',
            'features'        => 'required|array|min:1',
            'features.*'      => 'required|string',
            'is_popular'      => 'boolean',
            'is_active'       => 'boolean',
        ];
    }
}
