<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'title_pre' => 'nullable|string|max:250',
            'first_name' => 'required|string|max:250',
            'title_mid' => 'nullable|string|max:250',
            'last_name' => 'required|string|max:250',
            'title_post' => 'nullable|string|max:250',
            'email' => 'nullable|string|email:rfc,dns|max:250|unique:customers,email',
            'phone' => 'required|string|max:20',
            'secondary_phone' => 'nullable|string|max:20',
            'address_line1' => 'required|string|max:250',
            'address_line2' => 'nullable|string|max:250',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'preferred_contact_method' => 'required|in:phone,text,mail',
            'notes' => 'nullable|string|max:4000',
            'emergency_contact_name' => 'nullable|string|max:250',
            'emergency_contact_phone' => 'nullable|string|max:20',
        ];

    }
}
