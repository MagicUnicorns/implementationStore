<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatientVisitRequest;
use App\Http\Requests\UpdatePatientVisitRequest;
use App\Models\Patient;
use App\Models\Visit;

class PatientVisitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-patient-visit|edit-patient-visit|delete-patient-visit', ['only' => ['index','show']]);
        $this->middleware('permission:create-patient-visit', ['only' => ['create','store']]);
        $this->middleware('permission:edit-patient-visit', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-patient-visit', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Patient $patient)
    {
        return view('patient_visits.index', [
            'patient_visits' => $patient->patient_visits()->paginate(10),
        ]);
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
    public function store(StorePatientVisitRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Visit $patientVisit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Visit $patientVisit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientVisitRequest $request, Visit $patientVisit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visit $patientVisit)
    {
        //
    }
}
