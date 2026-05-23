<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMemberRequest extends FormRequest
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
            'name'               => 'sometimes|required|string|max:255',
            'email'              => 'sometimes|required|email|unique:members,email,' . $this->route('member'),
            'phone'              => 'nullable|string|max:20',
            'address'            => 'nullable|string|max:500',
            'membership_plan_id' => 'sometimes|required|exists:membership_plans,id',
            'join_date'          => 'sometimes|required|date',
            'status'             => 'sometimes|required|in:active,inactive,expired',
            'photo'              => 'nullable|image|mimes:jpeg,png,webp|max:2048',
        ];
    }
}
