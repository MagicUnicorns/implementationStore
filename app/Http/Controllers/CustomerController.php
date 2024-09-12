<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Http\Requests\StoreCustomerRequest;
use Illuminate\Http\RedirectResponse;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-customer|edit-customer|delete-customer', ['only' => ['index','show']]);
        $this->middleware('permission:create-customer', ['only' => ['create','store']]);
        $this->middleware('permission:edit-customer', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-customer', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('customers.index', [
            'customers' => Customer::latest('id')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request) : RedirectResponse
    {
        $customer = Customer::create([
            'title_pre' => $request->input('title_pre'),
            'first_name' => $request->input('first_name'),
            'title_mid' => $request->input('title_mid'),
            'last_name' => $request->input('last_name'),
            'title_post' => $request->input('title_post'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'secondary_phone' => $request->input('secondary_phone'),
            'address_line1' => $request->input('address_line1'),
            'address_line2' => $request->input('address_line2'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'postal_code' => $request->input('postal_code'),
            'country' => $request->input('country'),
            'preferred_contact_method' => $request->input('preferred_contact_method'),
            'notes' => $request->input('notes'),
            'emergency_contact_name' => $request->input('emergency_contact_name'),
            'emergency_contact_phone' => $request->input('emergency_contact_phone'),
            'organization_id' => auth()->user()->organization_id,
        ]);


        return redirect()->route('customers.index')
                ->withSuccess('New customer added successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer) : View
    {
        return view('customers.show', [
            'customer' => $customer
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
