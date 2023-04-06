@extends('layouts.app')

@section('content')
<div class="container">
    <!-- <div class="row">
        <div>
            Hello {{ Auth::user()->username }}! This is the DROPIN site! <br>
            
        </div>
    </div> -->
    <div class="row">
        <div class="dropin-container col-8" id="dropin-container">

        </div>    
        <div class="col-4 h-100">
            @auth
            <div class="row row-flex">    
                <payments-body-component user-id="{{ Auth::user()->id }}"></payments-body-component>
            </div>
            <div class="row row-flex">
                <payments-response-component user-id="{{ Auth::user()->id }}"></payments-response-component>
            </div>
            @endauth
        </div>
    </div>
    <div class="row pt-5">
        <payments-component></payments-component>
    </div>
</div>
@endsection
