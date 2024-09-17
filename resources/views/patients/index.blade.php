@extends('layouts.app')

@section('content')

@can('create-customer')
    <h2>Neuen Patienten erstellen</h2>
    <a href="{{ route('patients.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Patient</a>
@endcan

<patient-component></patient-component>

@endsection