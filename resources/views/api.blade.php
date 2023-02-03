@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div>
            Hello {{ Auth::user()->username }}! This is the API site!
        </div>
    </div>
</div>
@endsection
