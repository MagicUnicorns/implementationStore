<template>
    <div class="container">
        <div class="row justify-content-center">
           
            <div id="create-transfer-instrument-container"></div>

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
                    getSdkToken: this.getSdkToken
                });

                console.log("legalEntityId11" + this.legalEntityId)
                console.log("transferInstrumentId11" + this.transferInstrumentId)

                const createTransferInstrumentComponent = adyenKycHandler
                    .create('createTransferInstrumentComponent', {
                        legalEntityId : this.legalEntityId,
                        transferInstrumentId: this.transferInstrumentId,
                        openBankingPartnerConfigId: 'YourBrandOBConfigId',
                        settings: {
                            allowIntraRegionCrossBorderPayout: true, // Optional
                            allowBankAccountFormatSelection: true // Optional
                        },
                        onSubmitSuccess: (submittedData) => {
                            console.log("In onSubmitSuccess()")
                            console.log(submittedData)
                            this.changeStep(this.legalEntityId, this.transferInstrumentId)
                        }
                    })
                    .mount('#create-transfer-instrument-container'); // Mount to the container you created`

            });
        },
        created(){

        },
        methods: {
            async getSdkToken() {
                return fetch('/adyen-onboarding-sdk-token',
                    { "policy": { "roles": ["createTransferInstrumentComponent"] } });
            },
            changeStep(legalEntityId, transferInstrumentId){
                this.$emit("nextStep", "manageTransferInstrumentComponent", transferInstrumentId);
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
