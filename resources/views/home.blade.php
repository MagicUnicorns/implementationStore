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
    <div class="row pt-5">
        <div class="col-4">
            <div class="card">
                <img class="card-img-top p-5" src="https://docs.adyen.com/user/pages/docs/02.online-payments/checkout-drop-in.svg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Card title1</h5>
                    <p class="card-text">Card text1</p>
                    <a href="{{ route('payments.dropin') }}" class="btn btn-primary btn-lg btn-block" role="button">Dropin</a>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <img class="card-img-top p-5" src="https://docs.adyen.com/user/pages/docs/02.online-payments/checkout-components.svg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Card title2</h5>
                    <p class="card-text">Card text2</p>
                    <a href="{{ route('payments.components') }}" class="btn btn-primary btn-lg btn-block" role="button">Components</a>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <img class="card-img-top p-5" src="https://docs.adyen.com/user/pages/docs/02.online-payments/checkout-api-only.svg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Card title3</h5>
                    <p class="card-text">Card text3</p>
                    <a href="{{ route('payments.api') }}" class="btn btn-primary btn-lg btn-block" role="button">API Only</a>
                </div>
            </div>
        </div>

        <!-- <div>
            Hallo {{ Auth::user()->username }}!
        </div> -->

    </div>
    <div class="row pt-5">
        <div class="col-4">
            <div class="card">
                <div class="card-click-to-pay">
                    <img class="card-img-top p-5" src="https://docs.adyen.com/user/pages/docs/02.online-payments/checkout-drop-in.svg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title1</h5>
                        <p class="card-text">Card text1</p>
                        <a href="{{ route('payments.dropin-ctp') }}" class="btn btn-primary btn-lg btn-block" role="button">Dropin Click to Pay</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="row pt-5">
                <payments-component></payments-component>
        </div> -->        
        <div class="row pt-5">
                <test-component></test-component>
        </div>
    </div>
</div>

@endsection
