<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreClassSessionRequest extends FormRequest
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
            'description'      => 'nullable|string',
            'trainer_id'       => 'required|exists:trainers,id',
            'category'         => 'nullable|string|max:100',
            'schedule_day'     => 'required|string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'schedule_time'    => 'required|date_format:H:i',
            'duration_minutes' => 'required|integer|min:15|max:180',
            'capacity'         => 'required|integer|min:1',
            'is_active'        => 'boolean',
        ];
    }
}
