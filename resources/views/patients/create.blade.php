@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Add New Patient
                </div>
                <div class="float-end">
                    <a href="{{ route('patients.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('patients.store') }}" method="post">
                    @csrf

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="gender" class="col-md-4 col-form-label text-md-end text-start">Geschlecht</label>
                        <div class="col-md-6">
                            <select class="form-select" aria-label="Default select example" name="gender" id="gender">
                                <option {{ old('gender') == 'unknown' ? 'selected' : '' }} value="unknown">unknown</option>
                                <option {{ old('gender') == 'female' ? 'selected' : '' }} value="female">female</option>
                                <option {{ old('gender') == 'male' ? 'selected' : '' }} value="male">male</option>
                            </select>
                            @if ($errors->has('gender'))
                                <span class="text-danger">{{ $errors->first('gender') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="date_of_birth" class="col-md-4 col-form-label text-md-end text-start">Geburtsdatum</label>
                        <div class="col-md-6">
                        <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}">
                            @if ($errors->has('date_of_birth'))
                                <span class="text-danger">{{ $errors->first('date_of_birth') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="date_deceased" class="col-md-4 col-form-label text-md-end text-start">Gestorben am</label>
                        <div class="col-md-6">
                        <input type="date" class="form-control @error('date_deceased') is-invalid @enderror" id="date_deceased" name="date_deceased" value="{{ old('date_deceased') }}">
                            @if ($errors->has('date_deceased'))
                                <span class="text-danger">{{ $errors->first('date_deceased') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="notes" class="col-md-4 col-form-label text-md-end text-start">Notizen</label>
                        <div class="col-md-6">
                            <textarea type="text" class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes"  value="{{ old('notes') }}"></textarea>
                            @if ($errors->has('notes'))
                                <span class="text-danger">{{ $errors->first('notes') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="medical_history_summary" class="col-md-4 col-form-label text-md-end text-start">Zusammenfassung</label>
                        <div class="col-md-6">
                            <textarea type="text" class="form-control @error('medical_history_summary') is-invalid @enderror" id="medical_history_summary" name="medical_history_summary"  value="{{ old('medical_history_summary') }}"></textarea>
                            @if ($errors->has('medical_history_summary'))
                                <span class="text-danger">{{ $errors->first('medical_history_summary') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Add Patient">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>    
@endsection