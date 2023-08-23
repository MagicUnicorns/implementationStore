import AdyenCheckout from '@adyen/adyen-web';

export async function dropin(paymentMethodsArray, mount = true, element = 'dropin-container'){

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
              console.log("handleAction:")
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
        onAdditionalDetails(state, dropin){
          console.log("onAdditionalDetails called: ");
          console.log(state.data);
          const response = submitDetails(state.data)
          .then(response => handleServerResponse(response));
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
      
      if (mount)
        return (await AdyenCheckout(configuration)).create('dropin').mount(document.getElementById(element))

      return await AdyenCheckout(configuration)
}

const httpPost = (endpoint, data) =>
    fetch(`${endpoint}`, {
        method: "POST",
        headers: {
            Accept: "application/json, text/plain, */*",
            "Content-Type": "application/json",
            "X-CSRF-Token": document.querySelector('input[name=_token]').value
        },
        body: JSON.stringify(data),
    }).then((response) => response.json());

async function makePayment(data){
  try {
    const response = await httpPost("/payments", data);
    console.log(response);
    if (response.error)
      throw "Payment initiation failed";
    return response;
  } catch (data_2) {
    return console.error(data_2);
  }
}

async function submitDetails(data){
  try{
    const response = await httpPost("/payments/details", data);
    console.log("/payments/details response:");
    console.log(response);
    if(response.error)
      throw "/payments/details call failed!"
    return response;
  } catch (message){
    return console.error(message);
  }
}

function showFinalResult(res) {
  console.log("resultCode+::");
  console.log(res.resultCode)
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