//console.log(import.meta.env.VITE_ADYEN_CLIENT_KEY);

import { dropin } from './adyen/dropin.js';

import '@adyen/adyen-web/dist/adyen.css';


if(document.getElementsByClassName('dropin-container').length){
    //mount dropin

    let paymentMethods = getPaymentMethods()

    const checkout = dropin(paymentMethods);

    console.log('test1')
    console.log(checkout)
    console.log('test2')

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