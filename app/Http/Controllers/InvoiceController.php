<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-invoice|edit-invoice|delete-invoice', ['only' => ['index','show']]);
        $this->middleware('permission:create-invoice', ['only' => ['create','store']]);
        $this->middleware('permission:edit-invoice', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-invoice', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {

        $validated = $request->validated();

        $invoice = Invoice::create($validated);

        return response()->json(['message' => 'Invoice created successfully!', 'invoice' => $invoice], 201);

        // Emaple payload:
        // {
        //     "invoice_number": "INV-2024-001",
        //     "customer_id": 5,
        //     "invoice_date": "2024-01-01",
        //     "due_date": "2024-01-15",
        //     "total_amount": 300.00,
        //     "paid_amount": 100.00,
        //     "currency": "USD",
        //     "status": "unpaid",
        //     "line_items": [
        //       {
        //         "description": "Vaccination",
        //         "quantity": 2,
        //         "price": 50.00
        //       },
        //       {
        //         "description": "Surgery",
        //         "quantity": 1,
        //         "price": 200.00
        //       }
        //     ],
        //     "notes": "Urgent invoice",
        //     "is_taxable": true,
        //     "tax_amount": 20.00,
        //     "discount_amount": 10.00,
        //     "reference": "ORDER-12345"
        //   }
         
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        $validated = $request->validated();

        $invoice->update($validated);

        return response()->json(['message' => 'Invoice updated successfully!', 'invoice' => $invoice], 200);

        // Example payload:
        // {
        //     "total_amount": 450.00,
        //     "paid_amount": 200.00,
        //     "due_date": "2024-02-01",
        //     "line_items": [
        //       {
        //         "description": "Dental Cleaning",
        //         "quantity": 1,
        //         "price": 150.00
        //       }
        //     ],
        //     "notes": "Updated invoice details",
        //     "status": "partially_paid"
        //   }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
