<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\Patient;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-patient|edit-patient|delete-patient', ['only' => ['index','show']]);
        $this->middleware('permission:create-patient', ['only' => ['create','store']]);
        $this->middleware('permission:edit-patient', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-patient', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('patients.index', [
            'patients' => Patient::latest('id')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientRequest $request)
    {
        $patient = Patient::create([
            'name' => $request->input('name'),
            'gender' => $request->input('gender'),
            'date_of_birth' => $request->input('date_of_birth'),
            'date_deceased' => $request->input('date_deceased'),
            'medical_history_summary' => $request->input('medical_history_summary'),
            'notes' => $request->input('notes'),
            'customer_id' => $request->input('customer_id'),
            'organization_id' => auth()->user()->organization_id,
        ]);

        return redirect()->route('patients.index')
                ->withSuccess('New patient added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        return view('patients.show', [
            'patient' => $patient
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        return view('patients.edit', [
            'patient' => $patient,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $input = $request->all();
        
        $patient->update($input);

        return redirect()->back()
                ->withSuccess('Patient is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        //TODO delete entries, etc.
        //TODO soft deletes
        $patient->delete();
        return redirect()->route('patients.index')
                ->withSuccess('Patient is deleted successfully.');
    }
}
