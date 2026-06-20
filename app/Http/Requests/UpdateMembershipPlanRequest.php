<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMembershipPlanRequest extends FormRequest
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
            'name'            => 'sometimes|required|string|max:255',
            'duration_months' => 'sometimes|required|integer|min:1',
            'price'           => 'sometimes|required|numeric|min:0',
            'features'        => 'sometimes|required|array|min:1',
            'features.*'      => 'required|string',
            'is_popular'      => 'boolean',
            'is_active'       => 'boolean',
        ];
    }
}
