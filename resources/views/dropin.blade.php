@extends('layouts.app')

@section('content')
<div class="container">
    <!-- {{ Auth::user() }} -->
    <div class="row d-flex">
        <div class="col-sm-12 col-md-8">
            <div class="row pt-5">
                <dropin-component></dropin-component>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Request
                    </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @auth
                            <payments-body-component user-id="{{ Auth::user()->id }}"></payments-body-component> 
                            @endauth
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Response
                    </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @auth
                            <payments-response-component user-id="{{ Auth::user()->id }}"></payments-response-component>
                            @endauth
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Webhooks
                    </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @auth
                            <webhooks-component user-id="{{ Auth::user()->id }}"></webhooks-component>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--For testing simple payment enable this, this will show a button which sends a test payments call to Adyen 
        <div class="row pt-5">
        <payments-component></payments-component>
    </div> -->

</div>
@endsection
