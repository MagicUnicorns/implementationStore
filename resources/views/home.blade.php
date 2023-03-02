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
    <div class="row">
        <div class="col-4">
            <div class="card">
                <img class="card-img-top p-5" src="https://docs.adyen.com/user/pages/docs/02.online-payments/checkout-drop-in.svg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Card title1</h5>
                    <p class="card-text">Card text1</p>
                    <!-- <button type="button" class="btn btn-primary btn-lg btn-block">Primary1</button> -->
                    <a href="{{ route('dropin') }}" class="btn btn-primary btn-lg btn-block" role="button">Dropin</a>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <img class="card-img-top p-5" src="https://docs.adyen.com/user/pages/docs/02.online-payments/checkout-components.svg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Card title2</h5>
                    <p class="card-text">Card text2</p>
                    <a href="{{ route('components') }}" class="btn btn-primary btn-lg btn-block" role="button">Components</a>
                </div>
            </div>
        </div>
        <div class="col-4">
        <div class="card">
            <img class="card-img-top p-5" src="https://docs.adyen.com/user/pages/docs/02.online-payments/checkout-api-only.svg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Card title3</h5>
                    <p class="card-text">Card text3</p>
                    <a href="{{ route('api') }}" class="btn btn-primary btn-lg btn-block" role="button">API Only</a>
                </div>
            </div>
        </div>
        <!-- <div>
            Hallo {{ Auth::user()->username }}!
        </div> -->
    </div>
</div>
@endsection
