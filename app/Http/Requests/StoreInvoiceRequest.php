<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
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
            'invoice_number' => 'required|string|unique:invoices,invoice_number|max:250',
            'customer_id' => 'required|exists:customers,id',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:invoice_date',
            'total_amount' => 'required|numeric|min:0',
            'paid_amount' => 'nullable|numeric|min:0|lte:total_amount',
            'currency' => 'required|string|size:3',
            'status' => 'required|in:unpaid,paid,partially_paid,overdue,canceled',
            'line_items' => 'required|array|min:1',
            'line_items.*.description' => 'required|string|max:255',
            'line_items.*.quantity' => 'required|integer|min:1',
            'line_items.*.price' => 'required|numeric|min:0',
            'notes' => 'nullable|string|max:4000',
            'payment_method' => 'nullable|string|max:150',
            'billing_address' => 'nullable|string|max:255',
            'shipping_address' => 'nullable|string|max:255',
            'is_taxable' => 'required|boolean',
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
            'line_items.required' => 'At least one line item is required.',
            'line_items.*.description.required' => 'Each line item must have a description.',
            'line_items.*.quantity.required' => 'Each line item must have a quantity.',
            'line_items.*.price.required' => 'Each line item must have a price.',
        ];
    }
}
