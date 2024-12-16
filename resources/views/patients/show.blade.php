@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Patient Information
                </div>
                <div class="float-end">
                    <div class="btn-group">
                        <a href="{{ route('patients.index') }}" class="btn btn-primary btn-sm me-1">&larr; Back</a>
                        <form action="{{ route('patients.destroy', $patient->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            @can('edit-patient')
                                <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-primary btn-sm me-1"><i class="bi bi-pencil-square"></i> Edit</a>
                            @endcan

                            @can('delete-patient')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this patient?');"><i class="bi bi-trash"></i> Delete</button>
                            @endcan
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Name:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $patient->name }}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="gender" class="col-md-4 col-form-label text-md-end text-start"><strong>Gender:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $patient->gender }}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="date_of_birth" class="col-md-4 col-form-label text-md-end text-start"><strong>Date of birth:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $patient->date_of_birth ? $patient->date_of_birth->format('d.m.Y') : '' }}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="date_deceased" class="col-md-4 col-form-label text-md-end text-start"><strong>Date deceased:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $patient->date_deceased ? $patient->date_deceased->format('d.m.Y H:i') : '' }}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="notes" class="col-md-4 col-form-label text-md-end text-start"><strong>Notes:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $patient->notes }}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="medical_history_summary" class="col-md-4 col-form-label text-md-end text-start"><strong>Medical summary:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $patient->medical_history_summary }}
                        </div>
                    </div>
            </div>
        </div>
        <div class="card">
            <patient-visits-component :patient_id="'{{$patient->id}}'"></patient-visits-component>
            @can('create-patient-visit')
                <a href="{{ route('patient-visits.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Entry</a>
            @endcan
        </div>
    </div>
</div>
@endsection
