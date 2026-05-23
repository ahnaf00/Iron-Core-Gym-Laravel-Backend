<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateClassSessionRequest extends FormRequest
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
            'name'             => 'sometimes|required|string|max:255',
            'description'      => 'nullable|string',
            'trainer_id'       => 'sometimes|required|exists:trainers,id',
            'category'         => 'nullable|string|max:100',
            'schedule_day'     => 'sometimes|required|string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'schedule_time'    => 'sometimes|required|date_format:H:i',
            'duration_minutes' => 'sometimes|required|integer|min:15|max:180',
            'capacity'         => 'sometimes|required|integer|min:1',
            'is_active'        => 'boolean',
        ];
    }
}
