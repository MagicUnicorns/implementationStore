@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div>
            Hello {{ Auth::user()->username }}! This is the COMPONENTS site!
        </div>
    </div>
</div>
@endsection
