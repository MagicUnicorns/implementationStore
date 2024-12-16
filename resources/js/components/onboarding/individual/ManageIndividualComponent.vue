<template>
    <div class="container">
        <div class="row justify-content-center">
        
            <div id="manage-individual-container"></div>

        </div>
    </div>
</template>

<script>
    import AdyenKyc from '@adyen/kyc-components';
    import '@adyen/kyc-components/styles.css';
    export default {
        data() {
            return {
                // result: "Nix"
            }
        },
        props: {
            legalEntityId: String,
        },
        computed(){

        },
        async mounted() {
            
                // console.log("test123123131231")
                const adyenKycHandler = new AdyenKyc({
                    locale: 'de-DE',
                    country: 'DE',
                    environment: 'https://test.adyen.com',
                    sdkToken: await this.getSdkToken(),
                    getSdkToken: this.getSdkToken
                });

                // console.log("legalEntityId123433="  + this.legalEntityId)

                const openIndividual = () => adyenKycHandler
                    .create('createIndividualComponent', {
                        legalEntityId: this.legalEntityId,
                        onSubmitSuccess: (submittedData) => {mountIndividualComponent()}, // Upon form completion
                        modalView: false, // Show in a modal window or inline
                        onClose: () => {mountIndividualComponent()} // Optional, when the user selects Close. For the modal view only
                    })
                .mount('#manage-individual-container'); // Mount to the container you created

                const mountIndividualComponent = () => {
                    const manageIndividualComponent = adyenKycHandler
                        .create('manageIndividualComponent', {
                            legalEntityId: this.legalEntityId,
                            onClick: () => openIndividual(),
                        })
                        .mount('#manage-individual-container'); // Mount to the container you created`
                }

                mountIndividualComponent()
        },
        methods: {
            async getSdkToken() {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                const response = await fetch('/adyen-onboarding-sdk-token',{
                    method: 'POST',
                    headers: {'Content-Type':'application/json', 'Accept':'application/json', 'X-CSRF-TOKEN': csrfToken},
                    body: '{ "policy": { "roles": ["manageIndividualComponent"] } }'
                });
                // console.log("tokenx =" + await response.json())
                const responseJson=await response.json()

                // console.log("-----123")
                // console.log(responseJson.token)
                // console.log("-----123")

                return responseJson.token;

            },
            changeStep(legalEntityId){
                this.$emit("nextStep", "createIndividualComponent");
            }
        }
    }
</script>

<style>
:root {
    /** Setting the primary inverse background color (ex. main button colors) */
    --adyen-sdk-color-background-inverse-primary: #7e5bed;
    --adyen-sdk-color-background-inverse-primary-hover:  #7e5bed;
    --adyen-sdk-color-background-inverse-primary-active:  #7e5bed;

    /** Setting the primary text color (ex. main body/heading colors) */
    --adyen-sdk-color-label-primary: #293d50;
    --adyen-sdk-color-label-primary-hover:  #293d50;
    --adyen-sdk-color-label-primary-active:  #293d50;

    /** Setting the secondary text color (ex. captions, helper text) */
    --adyen-sdk-color-label-secondary: rgba(117,117,117);
    --adyen-sdk-color-label-secondary-hover:  rgba(117,117,117);
    --adyen-sdk-color-label-secondary-active:  rgba(117,117,117);

    /** Setting the color for links */
    --adyen-sdk-color-link-primary: #7e5bed;
    --adyen-sdk-color-link-primary-hover: #7e5bed;
    --adyen-sdk-color-link-primary-active:  #7e5bed;
    --adyen-sdk-color-link-primary-disabled: #8d95a3;

    /** Setting the default font family to Inter */
    --adyen-sdk-text-body-font-family: Inter,sans-serif;
    --adyen-sdk-text-caption-font-family: Inter,sans-serif;
    --adyen-sdk-text-title-font-family: Inter,sans-serif;
    --adyen-sdk-text-title-m-font-family: Inter,sans-serif;
    --adyen-sdk-text-title-l-font-family: Inter,sans-serif;

    /** Setting the font weights to custom values */
    --adyen-sdk-text-body-font-weight: 500;
    --adyen-sdk-text-caption-font-weight: 500;
    --adyen-sdk-text-body-stronger-font-weight: 600;
    --adyen-sdk-text-caption-stronger-font-weight: 600;
    --adyen-sdk-text-body-strongest-font-weight: 700;
    --adyen-sdk-text-title-font-weight: 700;
    --adyen-sdk-text-title-m-font-weight: 700;
    --adyen-sdk-text-title-l-font-weight: 700;

    /** Setting border radius for buttons and input fields */
    --adyen-sdk-border-radius-m: 15px;
}
</style>
