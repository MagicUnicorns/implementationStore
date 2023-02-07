//importing from .env file: console.log(import.meta.env.VITE_ADYEN_CLIENT_KEY);

import { dropin } from './adyen/dropin.js';
import { postData } from './util.js';

import '@adyen/adyen-web/dist/adyen.css';


if(document.getElementsByClassName('dropin-container').length){
    const redirectResult = (new URLSearchParams(window.location.search)).get('redirectResult')

    try{
        if(redirectResult){
            const result = submitDetails({details: {redirectResult}})
            console.log('result12=' + result)
        }
        else{
            let paymentMethods = getPaymentMethods()

            dropin(paymentMethods);
        }
    } catch (error) {
        console.error(error)
        alert("Error occurred, look at console for details");
    }
}

async function getPaymentMethods(){

    const response = await fetch('/api/paymentMethods', {
        method: 'POST', 
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'url': '/api/paymentMethods',
            "X-CSRF-Token": document.querySelector('input[name=_token]').value
        },
    })
    
    return await response.json();
}

async function submitDetails(data){

    const response = await postData('/api/payments/details', data)
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