<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
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
            'name'               => 'required|string|max:255',
            'email'              => 'required|email|unique:members,email',
            'phone'              => 'nullable|string|max:20',
            'address'            => 'nullable|string|max:500',
            'membership_plan_id' => 'required|exists:membership_plans,id',
            'join_date'          => 'required|date',
            'status'             => 'required|in:active,inactive,expired',
            'photo'              => 'nullable|image|mimes:jpeg,png,webp|max:2048',
        ];
    }
}
