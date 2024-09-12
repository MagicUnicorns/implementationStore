@extends('layouts.app')

@section('content')

@can('create-customer')
    <h2>Neuen Kunden erstellen</h2>
    <a href="{{ route('customers.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Customer</a>
@endcan

<customer-component></customer-component>

@endsection