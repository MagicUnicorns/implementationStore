@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/user/{{$user->id}}" enctype="multipart/form-data" method="POST">
        {{ method_field('PATCH') }}
        @csrf

        <div class="row pt-2">
            <div class="col-8 offset-2">
                <div class="row">
                    <h1>Edit User {{$user->name}}</h1>
                </div>

                <div class="row">
                    <label for="name" class="col-md-2 col-form-label">{{ __('Name') }}</label>

                    <div class="col-md-10">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->name }}" autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row pt-2">
                    <label for="username" class="col-md-2 col-form-label">{{ __('Username') }}</label>

                    <div class="col-md-10">
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') ?? $user->username }}" autocomplete="name">

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
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $user->email }}" autocomplete="email" autofocus>

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
                                @foreach ($roles as $role)
                                <option value="{{ $role }}" {{ (old('role') ?? $user->role->value) == $role->value ? "selected":"" }}>{{ $role }}</option>
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

                <div class="row pt-4 col-md-2">
                    <button class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
