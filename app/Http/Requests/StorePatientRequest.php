<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:250',
            'gender' => 'required|in:male,female,unknown',
            'date_of_birth' => 'required|date|before_or_equal:today',
            'date_deceased' =>'nullable|date|before_or_equal:today',
            'medical_history_summary' => 'nullable|string|max:4000',
            'notes' => 'nullable|string|max:4000',
        ];
    }
}
