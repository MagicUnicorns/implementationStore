<template>
    <div class="container">
        <div class="row justify-content-center">
        
            <div id="transaction-list-container"></div>

        </div>
    </div>
</template>

<script>
    import { AdyenPlatformExperience, TransactionsOverview } from '@adyen/adyen-platform-experience-web';
    import "@adyen/adyen-platform-experience-web/adyen-platform-experience-web.css";

    export default {
        data() {
            return {
                // result: "Nix"
            }
        },
        props: {
            balanceAccountId: String
        },
        computed(){

        },
        async mounted() {
            this.getSdkToken().then((response) => {
        
                const core =  AdyenPlatformExperience({
                    locale: 'en-EN',
                    environment: 'test',
                    sdkToken: response,
                    onSessionCreate: this.getSdkToken // Pass function reference  
                });
                
                return core;
            }).then((core) => { 
                console.log("core=");
                console.log(core);

                // Create the instance of TransactionsOverview without `then`
                const transactionsOverviewComponent = new TransactionsOverview({ "core": core, "preferredLimit": 10, "allowLimitSelection": true });
                
                // Mount the component once created
                transactionsOverviewComponent.mount('#transaction-list-container'); // Mount to the container you created
            });
        },
        methods: {
            async getSdkToken() {
                const response = await fetch('/adyen-reporting-sdk-token',
                {
                    // {
                    // "allowOrigin": "http://localhost:8080",
                    // "product": "platform",
                    // "policy": {
                    //     "resources": [
                    //         {
                    //             "accountHolderId": "AH3295522322845LC2BMJ73NT",
                    //             "type": "accountHolder"
                    //         }
                    //     ],
                    //     "roles": [
                    //         "Transactions Overview Component: View"
                    //     ]
                    // }
                });
                return response.json()
            },
            changeStep(balanceAccountId, transactionId){
                this.$emit("nextStep", "transactionDetailComponent", transactionId);
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
