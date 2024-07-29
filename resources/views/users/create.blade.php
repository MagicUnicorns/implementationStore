@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/user" enctype="multipart/form-data" method="post">

        @csrf

        <div class="row pt-2">
            <div class="col-8 offset-2">
                <div class="row">
                    <h1>Add new User</h1>
                </div>

                <div class="row">
                    <label for="name" class="col-md-2 col-form-label">{{ __('Name') }}</label>

                    <div class="col-md-10">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row pt-2">
                    <label for="name" class="col-md-2 col-form-label">{{ __('Username') }}</label>

                    <div class="col-md-10">
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" autocomplete="username">

                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row pt-2">
                    <label for="email" class="col-md-2 col-form-label">{{ __('Email') }}</label>

                    <div class="col-md-10">
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row pt-2">
                    <label for="role" class="col-md-2 col-form-label">{{ __('Role') }}</label>

                    <div class="col-md-10">
                        <div class="form-group{{ $errors->has('roles') ? ' has-error' : '' }}">
                            <label for="roles" class="col-md-4 control-label">Select a Role</label>
                            <div class="col-md-6">

                                <select class="form-control" id="role" name="role">
                                <option value="">Select a Role</option>
                                @foreach ($roles as $role)
                                <option value="{{ $role }}">{{ $role }}</option>
                                @endforeach
                                </select>
                                @if ($errors->has('roles'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('roles') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row pt-2">
                    <label for="password" class="col-md-2 col-form-label">{{ __('Password') }}</label>

                    <div class="col-md-10">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" autocomplete="password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
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
