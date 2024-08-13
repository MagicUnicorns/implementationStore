@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex">
        <div class="col-sm-12 col-md-8">
            Hello {{ Auth::user()->username }}! This is the API site!
        </div>

        @include('util.message-sidebar')

    </div>
</div>
@endsection
