@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Customer Information
                </div>
                <div class="float-end">
                    <div class="btn-group">
                        <a href="{{ route('customers.index') }}" class="btn btn-primary btn-sm me-1">&larr; Back</a>
                        <form action="{{ route('customers.destroy', $customer->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            @can('edit-customer')
                                <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-primary btn-sm me-1"><i class="bi bi-pencil-square"></i> Edit</a>
                            @endcan

                            @can('delete-customer')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this customer?');"><i class="bi bi-trash"></i> Delete</button>
                            @endcan
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-3 row">
                    <label for="title_pre" class="col-md-4 col-form-label text-md-end text-start"><strong>Titel:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $customer->title_pre }}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="first_name" class="col-md-4 col-form-label text-md-end text-start"><strong>Vorname:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $customer->first_name }}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="title_mid" class="col-md-4 col-form-label text-md-end text-start"><strong>Titel:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $customer->title_mid }}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="last_name" class="col-md-4 col-form-label text-md-end text-start"><strong>Nachname:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $customer->last_name }}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="title_post" class="col-md-4 col-form-label text-md-end text-start"><strong>Titel:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $customer->title_post }}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="email" class="col-md-4 col-form-label text-md-end text-start"><strong>Email Address:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $customer->email }}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="phone" class="col-md-4 col-form-label text-md-end text-start"><strong>Telefonnummer:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $customer->phone }}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="secondary_phone" class="col-md-4 col-form-label text-md-end text-start"><strong>Telefonnummer2:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $customer->secondary_phone }}
                    </div>
                </div>


                <div class="mb-3 row">
                    <label for="address_line1" class="col-md-4 col-form-label text-md-end text-start"><strong>Adresse:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $customer->address_line1 }}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="address_line2" class="col-md-4 col-form-label text-md-end text-start"><strong>Adresszusatz:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $customer->address_line2 }}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="city" class="col-md-4 col-form-label text-md-end text-start"><strong>Ort:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $customer->city }}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="state" class="col-md-4 col-form-label text-md-end text-start"><strong>Bundesland:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $customer->state }}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="postal_code" class="col-md-4 col-form-label text-md-end text-start"><strong>Postleitzahl:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $customer->postal_code }}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="country" class="col-md-4 col-form-label text-md-end text-start"><strong>Land:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $customer->country }}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="preferred_contact_method" class="col-md-4 col-form-label text-md-end text-start"><strong>Preäferierte Kontaktart:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $customer->preferred_contact_method }}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="notes" class="col-md-4 col-form-label text-md-end text-start"><strong>Notizen:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $customer->notes }}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="emergency_contact_name" class="col-md-4 col-form-label text-md-end text-start"><strong>Notfallkontakt:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $customer->emergency_contact_name }}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="emergency_contact_phone" class="col-md-4 col-form-label text-md-end text-start"><strong>Notfallkontakt Telefonnummer:</strong></label>
                    <div class="col-md-6" style="line-heigt: 35px;">
                        {{ $customer->emergency_contact_phone }}
                    </div>h
                </div>
            </div>
        </div>
        <div class="card">
            <patient-component :customer_id="'{{$customer->id}}'"></patient-component>
            @can('create-customer')
                <a href="{{ route('patients.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Patient</a>
            @endcan
        </div>
    </div>
</div>
@endsection
