<div class="col-sm-12 col-md-4">
            <div class="accordion" id="apiAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingPaymentsRequest">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePaymentsRequest" aria-expanded="true" aria-controls="collapsePaymentsRequest">
                        /payments request
                    </button>
                    </h2>
                    <div id="collapsePaymentsRequest" class="accordion-collapse collapse show" aria-labelledby="headingPaymentsRequest" data-bs-parent="#apiAccordion">
                        <div class="accordion-body">
                            @auth
                            <payments-body-component user-id="{{ Auth::user()->id }}"></payments-body-component> 
                            @endauth
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingPaymentsResponse">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePaymentsResponse" aria-expanded="false" aria-controls="collapsePaymentsResponse">
                        /payments response
                    </button>
                    </h2>
                    <div id="collapsePaymentsResponse" class="accordion-collapse collapse" aria-labelledby="headingPaymentsResponse" data-bs-parent="#apiAccordion">
                        <div class="accordion-body">
                            @auth
                            <payments-response-component user-id="{{ Auth::user()->id }}"></payments-response-component>
                            @endauth
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingPaymentsDetailsRequest">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePaymentsDetailsRequest" aria-expanded="false" aria-controls="collapsePaymentsDetailsRequest">
                        /payment/details request
                    </button>
                    </h2>
                    <div id="collapsePaymentsDetailsRequest" class="accordion-collapse collapse" aria-labelledby="headingPaymentsDetailsRequest" data-bs-parent="#apiAccordion">
                        <div class="accordion-body">
                            @auth
                            <payments-details-request-component user-id="{{ Auth::user()->id }}"></payments-details-request-component>
                            @endauth
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingPaymentsDetailsResponse">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePaymentsDetailsResponse" aria-expanded="false" aria-controls="collapsePaymentsDetailsResponse">
                        /payment/details response
                    </button>
                    </h2>
                    <div id="collapsePaymentsDetailsResponse" class="accordion-collapse collapse" aria-labelledby="headingPaymentsDetailsResponse" data-bs-parent="#apiAccordion">
                        <div class="accordion-body">
                            @auth
                            <payments-details-response-component user-id="{{ Auth::user()->id }}"></payments-details-response-component>
                            @endauth
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingWebhooks">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWebhooks" aria-expanded="false" aria-controls="collapseWebhooks">
                        Webhooks
                    </button>
                    </h2>
                    <div id="collapseWebhooks" class="accordion-collapse collapse" aria-labelledby="headingWebhooks" data-bs-parent="#apiAccordion">
                        <div class="accordion-body">
                            @auth
                            <webhooks-component user-id="{{ Auth::user()->id }}"></webhooks-component>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>  
        </div>