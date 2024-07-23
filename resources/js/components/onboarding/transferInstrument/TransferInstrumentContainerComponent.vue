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
                transferInstrumentId: ""
            }
        },
        props: {
            legalEntityId: String,
        },
        created(){
            console.log(this.legalEntityId)
            console.log("123523")
            
        },
        methods: {
        changeStep(step, transferInstrumentId){
            this.selectedComponent = step;
            this.transferInstrumentId = transferInstrumentId
        }
        },
        components: {
            manageTransferInstrumentComponent,
            createTransferInstrumentComponent
        }
    }
</script>
