<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //invoice_number must remain unique, except for the current invoice being updated. 
            //The ignore($this->invoice) ensures the invoice itself isn't flagged for duplication.
            'invoice_number' => [
                'sometimes', 'string', 'max:50',
                Rule::unique('invoices')->ignore($this->invoice)
            ],
            'customer_id' => 'sometimes|exists:customers,id',
            'invoice_date' => 'sometimes|date',
            'due_date' => 'sometimes|date|after_or_equal:invoice_date',
            'total_amount' => 'sometimes|numeric|min:0',
            'paid_amount' => 'nullable|numeric|min:0|lte:total_amount',
            'currency' => 'sometimes|string|size:3',
            'status' => 'sometimes|in:unpaid,paid,partially_paid,overdue,canceled',
            'line_items' => 'sometimes|array|min:1',
            'line_items.*.description' => 'required_with:line_items|string|max:255',
            'line_items.*.quantity' => 'required_with:line_items|integer|min:1',
            'line_items.*.price' => 'required_with:line_items|numeric|min:0',
            'notes' => 'nullable|string|max:4000',
            'payment_method' => 'nullable|string|max:150',
            'billing_address' => 'nullable|string|max:255',
            'shipping_address' => 'nullable|string|max:255',
            'is_taxable' => 'sometimes|boolean',
            'tax_amount' => 'nullable|numeric|min:0',
            'discount_amount' => 'nullable|numeric|min:0',
            'reference' => 'nullable|string|max:200'
        ];
    }

        /**
     * Custom error messages for validation failures.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'customer_id.exists' => 'The selected customer does not exist.',
            'due_date.after_or_equal' => 'The due date must be on or after the invoice date.',
            'line_items.required_with' => 'Line items are required when updating item details.',
            'line_items.*.description.required_with' => 'Each line item must have a description.',
            'line_items.*.quantity.required_with' => 'Each line item must have a quantity.',
            'line_items.*.price.required_with' => 'Each line item must have a price.',
        ];
    }
}
