@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/profile/{{$profile->id}}" enctype="multipart/form-data" method="POST">
        {{ method_field('PATCH') }}
        @csrf

        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                    <h1>Edit Profile {{$profile->name}}</h1>
                </div>

                <div class="row">
                    <label for="name" class="col-md-2 col-form-label">{{ __('Name') }}</label>

                    <div class="col-md-10">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $profile->name }}" autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row pt-4">
                    <label for="image" class="col-md-2 col-form-label">{{ __('Image') }}</label>
                    <div class="col-md-1">
                        <img src="/storage/{{$profile->image}}" style="max-width: 100%">
                    </div>
                    <div class="col-md-9">
                        <input type = "file" class="form-control-file" id="image" name="image">

                        @error('image')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <div class="row pt-4 col-md-2">
                    <button class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
</form>
</div>
@endsection
