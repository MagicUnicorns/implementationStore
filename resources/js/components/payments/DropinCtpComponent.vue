<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="dropin-component-container col-8" id="dropin-component-container">

            </div> 
        </div>
        <!-- <div class="row justify-content-center" id="tempResultId">
            <div class="col-md-8">
                {{ result }}
            </div>
        </div> -->
    </div>
</template>

<script>
    import { dropin } from '../../adyen/dropin.js';

    export default {
        data() {
            return {
                // result: "Nix"
            }
        },
        mounted() {
            console.log('PaymentsComponent mounted.')

            //importing from .env file: console.log(import.meta.env.VITE_ADYEN_CLIENT_KEY);
            if(document.getElementsByClassName('dropin-component-container').length){
                const redirectResult = (new URLSearchParams(window.location.search)).get('redirectResult')

                try{
                    if(redirectResult){
                        const result = submitDetails({details: {redirectResult}})
                        console.log('result12=' + result)
                    }
                    else{
                        let paymentMethods = getPaymentMethods()

                        dropin(paymentMethods, true, 'dropin-component-container');
                    }
                } catch (error) {
                    console.error(error)
                    alert("Error occurred, look at console for details");
                }
            }

            async function getPaymentMethods(){

                const response = await fetch('/paymentMethods', {
                    method: 'POST', 
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'url': '/paymentMethods',
                        "X-CSRF-Token": document.querySelector('input[name=_token]').value
                    },
                })
                
                return await response.json();
            }

            async function submitDetails(data){

                const response = await postData('/payments/details', data)
                const result = await response.json();

                handleServerResponse(result);

                console.log('testtest' + JSON.stringify(result));
            }

            function handleServerResponse(res, _component) {
                switch (res.resultCode) {
                    case "Authorised":
                        window.location.href = "/result/success";
                        break;
                    case "Pending":
                    case "Received":
                        window.location.href = "/result/pending";
                        break;
                    case "Refused":
                        window.location.href = "/result/failed";
                        break;
                    default:
                        window.location.href = "/result/error";
                        break;
                }
            }
        },
        methods: {
            samplePayment(){
                axios.post('/payments')
                    .then(response => {
                        this.result = JSON.stringify(response, 1, 4);
                    });
            }
        }
    }
</script>
