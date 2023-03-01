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
    <h1>Merchant profiles</h1>
    <div class="row">
        Settings {{ $user->username }}
        <a href="{{ route('profile.create') }}" class="btn btn-primary btn-lg btn-block" role="button">Create new MerchantProfile</a>
    </div>
    <div class="row">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>image</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user->merchantProfiles as $merchantProfile)
                <tr>
                    <td>{{$merchantProfile->name}}</td>
                    <td>
                        <img src="/storage/{{$merchantProfile->image}}" class="w-10">
                    </td>
                    <td>
                        <a href="{{ route('profile.edit', ['id' => $merchantProfile->id]) }}" class="btn btn-secondary btn-lg btn-block" role="button">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
