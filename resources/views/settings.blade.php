@extends('layouts.app')

@section('content')
<div class="container">
<!--
    Auto generated stuff:
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
-->
    <h1>Settings</h1>
    <hr>
    <h2>Merchant profiles</h2>
    <div class="row">
        <!-- Settings {{ $user->username }} -->
        <a href="{{ route('profile.create') }}" class="btn btn-primary btn-lg btn-block" role="button">Create new MerchantProfile</a>
    </div>
    <div class="row">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>image</th>
                    <th style="text-align: right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user->merchantProfiles as $merchantProfile)
                <tr>
                    <td width = "10%">
                        <img src="/storage/{{$merchantProfile->image}}" style="max-width: 100%">
                    </td>
                    <td>{{$merchantProfile->name}}</td>
                    <td style="text-align: right" width="20%">
                        <div class = row>
                            <div class="col-6">
                                <a href="{{ route('profile.edit', ['id' => $merchantProfile->id]) }}" class="btn btn-success btn-lg btn-block" role="button">Edit</a>
                            </div>
                            <div class="col-6">
                                <form method="POST" action="{{ route('profile.destroy', ['id' => $merchantProfile->id]) }}">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-lg btn-block btn-danger" value="Delete">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <hr>
    <h2>Users</h2>
    <div class="row">
        <!-- Settings {{ $user->username }} -->
        <a href="{{ route('user.create') }}" class="btn btn-primary btn-lg btn-block" role="button">Create new User</a>
    </div>
    <div class="row">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>image</th>
                    <th style="text-align: right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user->organization->users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td style="text-align: right" width="20%">
                        <div class = row>
                            <div class="col-6">
                                <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-success btn-lg btn-block" role="button">Edit</a>
                            </div>
                            <div class="col-6">
                                <form method="POST" action="{{ route('user.destroy', ['id' => $user->id]) }}">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-lg btn-block btn-danger" value="Delete">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        <hr>
        <a href="/home" class="btn btn-primary btn-lg btn-block" role="button">Back</a>
    </div>
</div>
@endsection
