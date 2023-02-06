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