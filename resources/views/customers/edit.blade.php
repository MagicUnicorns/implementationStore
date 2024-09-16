@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Edit Customer
                </div>
                <div class="float-end">
                    <a href="{{ route('customers.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('customers.update', $customer->id) }}" method="post">
                    @csrf
                    @method("PUT")

                    <div class="mb-3 row">
                        <label for="title_pre" class="col-md-4 col-form-label text-md-end text-start">Titel</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('title_pre') is-invalid @enderror" id="title_pre" name="title_pre" value="{{ $customer->title_pre }}">
                            @if ($errors->has('title_pre'))
                                <span class="text-danger">{{ $errors->first('title_pre') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="first_name" class="col-md-4 col-form-label text-md-end text-start">Vorname</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ $customer->first_name }}">
                            @if ($errors->has('first_name'))
                                <span class="text-danger">{{ $errors->first('first_name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="title_mid" class="col-md-4 col-form-label text-md-end text-start">Titel</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('title_mid') is-invalid @enderror" id="title_mid" name="title_mid" value="{{ $customer->title_mid }}">
                            @if ($errors->has('title_mid'))
                                <span class="text-danger">{{ $errors->first('title_mid') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="last_name" class="col-md-4 col-form-label text-md-end text-start">Nachname</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ $customer->last_name }}">
                            @if ($errors->has('last_name'))
                                <span class="text-danger">{{ $errors->first('last_name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="title_post" class="col-md-4 col-form-label text-md-end text-start">Titel</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('title_post') is-invalid @enderror" id="title_post" name="title_post" value="{{ $customer->title_post }}">
                            @if ($errors->has('title_post'))
                                <span class="text-danger">{{ $errors->first('title_post') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="email" class="col-md-4 col-form-label text-md-end text-start">Email Address</label>
                        <div class="col-md-6">
                          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $customer->email }}">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="phone" class="col-md-4 col-form-label text-md-end text-start">Telefonnummer</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ $customer->phone }}">
                            @if ($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="secondary_phone" class="col-md-4 col-form-label text-md-end text-start">Telefonnummer2</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('secondary_phone') is-invalid @enderror" id="secondary_phone" name="secondary_phone" value="{{ $customer->secondary_phone }}">
                            @if ($errors->has('secondary_phone'))
                                <span class="text-danger">{{ $errors->first('secondary_phone') }}</span>
                            @endif
                        </div>
                    </div>


                    <div class="mb-3 row">
                        <label for="address_line1" class="col-md-4 col-form-label text-md-end text-start">Adresse</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('address_line1') is-invalid @enderror" id="address_line1" name="address_line1" value="{{ $customer->address_line1 }}">
                            @if ($errors->has('address_line1'))
                                <span class="text-danger">{{ $errors->first('address_line1') }}</span>
                            @endif
                        </div>
                    </div>


                    <div class="mb-3 row">
                        <label for="address_line2" class="col-md-4 col-form-label text-md-end text-start">Adresszusatz</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('address_line2') is-invalid @enderror" id="address_line2" name="address_line2" value="{{ $customer->address_line2 }}">
                            @if ($errors->has('address_line2'))
                                <span class="text-danger">{{ $errors->first('address_line2') }}</span>
                            @endif
                        </div>
                    </div>


                    <div class="mb-3 row">
                        <label for="city" class="col-md-4 col-form-label text-md-end text-start">Ort</label>
                        <div class="col-md-6">
                        <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ $customer->city }}">
                            @if ($errors->has('city'))
                                <span class="text-danger">{{ $errors->first('city') }}</span>
                            @endif
                        </div>
                    </div>


                    <div class="mb-3 row">
                        <label for="state" class="col-md-4 col-form-label text-md-end text-start">Bundesland</label>
                        <div class="col-md-6">
                        <input type="text" class="form-control @error('state') is-invalid @enderror" id="state" name="state" value="{{ $customer->state }}">
                            @if ($errors->has('state'))
                                <span class="text-danger">{{ $errors->first('state') }}</span>
                            @endif
                        </div>
                    </div>

                    
                    <div class="mb-3 row">
                        <label for="postal_code" class="col-md-4 col-form-label text-md-end text-start">Postleitzahl</label>
                        <div class="col-md-6">
                        <input type="text" class="form-control @error('postal_code') is-invalid @enderror" id="postal_code" name="postal_code" value="{{ $customer->postal_code }}">
                            @if ($errors->has('postal_code'))
                                <span class="text-danger">{{ $errors->first('postal_code') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="country" class="col-md-4 col-form-label text-md-end text-start">Land</label>
                        <div class="col-md-6">
                        <input type="text" class="form-control @error('country') is-invalid @enderror" id="country" name="country" value="{{ $customer->country }}">
                            @if ($errors->has('country'))
                                <span class="text-danger">{{ $errors->first('country') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="preferred_contact_method" class="col-md-4 col-form-label text-md-end text-start">Bevorzugte Kontaktart</label>
                        <div class="col-md-6">
                            <select class="form-select" aria-label="Default select example" name="preferred_contact_method" id="preferred_contact_method">
                                <option {{ $customer->preferred_contact_method == 'phone' ? 'selected' : '' }} value="phone">phone</option>
                                <option {{ $customer->preferred_contact_method == 'mail' ? 'selected' : '' }} value="mail">mail</option>
                                <option {{ $customer->preferred_contact_method == 'text' ? 'selected' : '' }} value="text">text</option>
                            </select>
                            @if ($errors->has('preferred_contact_method'))
                                <span class="text-danger">{{ $errors->first('preferred_contact_method') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="notes" class="col-md-4 col-form-label text-md-end text-start">Notizen</label>
                        <div class="col-md-6">
                            <textarea type="text" class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes"  value="{{ $customer->notes }}"></textarea>
                            @if ($errors->has('notes'))
                                <span class="text-danger">{{ $errors->first('notes') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="emergency_contact_name" class="col-md-4 col-form-label text-md-end text-start">Notfallkontakt</label>
                        <div class="col-md-6">
                        <input type="text" class="form-control @error('emergency_contact_name') is-invalid @enderror" id="emergency_contact_name" name="emergency_contact_name" value="{{ $customer->emergency_contact_name }}">
                            @if ($errors->has('emergency_contact_name'))
                                <span class="text-danger">{{ $errors->first('emergency_contact_name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="emergency_contact_phone" class="col-md-4 col-form-label text-md-end text-start">Telefonnummer Notfallkontakt</label>
                        <div class="col-md-6">
                        <input type="text" class="form-control @error('emergency_contact_phone') is-invalid @enderror" id="emergency_contact_phone" name="emergency_contact_phone" value="{{ $customer->emergency_contact_phone }}">
                            @if ($errors->has('emergency_contact_phone'))
                                <span class="text-danger">{{ $errors->first('emergency_contact_phone') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update Customer">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>    
@endsection