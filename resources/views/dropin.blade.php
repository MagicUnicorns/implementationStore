@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div>
            Hello {{ Auth::user()->username }}! This is the DROPIN site! <br>
            @json(Auth::user())
        </div>
        <div class="dropin-container" id="dropin-container">

        </div>    
    </div>
</div>
@endsection
