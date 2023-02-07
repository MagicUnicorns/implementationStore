import AdyenCheckout from '@adyen/adyen-web';

export async function dropin(paymentMethodsArray){
    console.log('dropint323');
    console.log( paymentMethodsArray);
    console.log(await paymentMethodsArray);

    const configuration = {
      paymentMethodsResponse: await paymentMethodsArray,
        environment: 'test', // Change to one of the environment values specified in step 4.
        clientKey: import.meta.env.VITE_ADYEN_CLIENT_KEY, // Public key used for client-side authentication: https://docs.adyen.com/development-resources/client-side-authentication
        analytics: {
          enabled: true // Set to false to not send analytics data to Adyen.
        },
        onPaymentCompleted: (result, component) => {
            console.info(result, component);
        },
        onError: (error, component) => {
            console.error(error.name, error.message, error.stack, component);
        },
        onSubmit(state, dropin){
          console.log(state.data);
          makePayment(state.data)
          .then(response => {
            if (response.action) {
              // Drop-in handles the action object from the /payments response
              dropin.handleAction(response.action);
            } else {
              // Your function to show the final result to the shopper
              showFinalResult(response);
            }
          })
          .catch(error => {
            throw Error(error);
          });
        },        
        onAdditionalData(state, dropin){
          console.log(state.data);
        },
        // Any payment method specific configuration. Find the configuration specific to each payment method:  https://docs.adyen.com/payment-methods
        // For example, this is 3D Secure configuration for cards:
        paymentMethodsConfiguration: {
          card: {
            hasHolderName: true,
            holderNameRequired: true,
            billingAddressRequired: true
          }
        }
      };
      
      return (await AdyenCheckout(configuration)).create('dropin').mount(document.getElementById('dropin-container'))
}

const httpPost = (endpoint, data) =>
    fetch(`${endpoint}`, {
        method: "POST",
        headers: {
            Accept: "application/json, text/plain, */*",
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    }).then((response) => response.json());

async function makePayment(data){
  try {
    const response = await httpPost("/api/payments", data);
    console.log(response);
    if (response.error)
      throw "Payment initiation failed";
    return response;
  } catch (data_2) {
    return console.error(data_2);
  }
}
