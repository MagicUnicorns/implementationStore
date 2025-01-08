@extends('layouts.app')

@section('content')

@can('create-customer')
    <h2>Neuen Rechnung erstellen</h2>
    <a href="{{ route('invoices.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Invoice</a>
@endcan

<invoice-component></invoice-component>

@endsection