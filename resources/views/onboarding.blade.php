@extends('layouts.app')

@section('content')

<div class="container">
    <!-- {{ Auth::user() }} -->
    <div class="row d-flex">
        <div class="col-sm-12 col-md-8">
            <div class="row pt-5">
                <onboarding-component></onboarding-component>
            </div>
        </div>

    </div>
    <!--For testing simple payment enable this, this will show a button which sends a test payments call to Adyen 
        <div class="row pt-5">
        <payments-component></payments-component>
    </div> -->
</div>

@endsection
