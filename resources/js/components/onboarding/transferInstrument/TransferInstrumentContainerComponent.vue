<template>
    <component @nextStep="changeStep" :is="selectedComponent" :legalEntityId="this.legalEntityId" :transferInstrumentId="this.transferInstrumentId"></component>
</template> 

<script>
    import createTransferInstrumentComponent from "./CreateTransferInstrumentComponent.vue"
    import manageTransferInstrumentComponent from "./ManageTransferInstrumentComponent.vue"

    export default {
        data() {
            return {
                selectedComponent: "manageTransferInstrumentComponent",
                legalEntityId: "LE3293S223225R5KZBJFS8944", //TODO get this from parent
                transferInstrumentId: ""
            }
        },
        created(){
            console.log(this.legalEntityId)
            console.log("123523")
            
        },
        methods: {
        changeStep(step, legalEntityId, transferInstrumentId){
            this.selectedComponent = step;
            this.legalEntityId = legalEntityId
            this.transferInstrumentId = transferInstrumentId
        }
        },
        components: {
            manageTransferInstrumentComponent,
            createTransferInstrumentComponent
        }
    }
</script>
