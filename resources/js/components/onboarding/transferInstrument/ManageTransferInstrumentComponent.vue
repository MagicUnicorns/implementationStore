<template>
    <div class="container">
        <div class="row justify-content-center">
        
            <div id="manage-transfer-instrument-container"></div>

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
            transferInstrumentId: String
        },
        computed(){

        },
        mounted() {
            this.getSdkToken().then((response) => {
                return response.json()
            }).then((response) => {
                console.log(response)

                const adyenKycHandler = new AdyenKyc({
                    locale: 'de-DE',
                    country: 'DE',
                    environment: 'https://test.adyen.com',
                    sdkToken: response.token,
                    getSdkToken: this.getSdkToken()
                });

                const manageTransferInstrumentComponent = adyenKycHandler
                    .create('manageTransferInstrumentComponent', {
                    legalEntityId: this.legalEntityId,
                    onAdd: (legalEntityId) => {
                        console.log("In onAdd()")
                        this.changeStep(legalEntityId, null)
                    },
                    onEdit: (transferInstrumentId, legalEntityId) => {
                        console.log("In onEdit()")
                        this.changeStep(legalEntityId, transferInstrumentId)
                    },
                    onRemoveSuccess: (transferInstrumentId, legalEntityId) => {
                        console.log("In onRemoveSuccess()")
                    },
                    settings: {
                        allowIntraRegionCrossBorderPayout: true, // Optional
                        allowBankAccountFormatSelection: true // Optional
                    }
                    })
                    .mount('#manage-transfer-instrument-container'); // Mount to the container you created`


            });
        },
        methods: {
            async getSdkToken() {
                return fetch('/adyen-onboarding-sdk-token',
                    { "policy": { "roles": ["manageTransferInstrumentComponent"] } });
            },
            changeStep(legalEntityId, transferInstrumentId){
                this.$emit("nextStep", "createTransferInstrumentComponent", transferInstrumentId);
            }
        }
    }
</script>

<style>
.adyen-kyc-label__text {
  font-weight: bold;
}
 
.adyen-kyc-dropin__content {
  background-color: #f1f1f1;
}
 
.adyen-kyc-field-verification-methods__card {
  background-color: #e2e2e2;
}
 
.adyen-action-bar {
  background-color: #f1f1f1;
}
 
.adyen-action-bar__button {
  background-color: #71e6af;
  border-radius: 60px;
  color: #000000;
  font-weight: 100;
}
 
.adl-button--secondary {
  background-color: #ffffff;
}
</style>
