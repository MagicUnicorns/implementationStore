

<template>
    <component @nextStep="changeStep" :is="selectedComponent"></component>
</template> 




<script>
    import createTransferInstrumentComponent from "../components/CreateTransferInstrumentComponent.vue"
    import manageTransferInstrumentComponent from "../components/ManageTransferInstrumentComponent.vue"

    export default {
        data() {
            return {
                selectedComponent: "manageTransferInstrumentComponent"
            }
        },
        methods: {
        changeStep(step){
            this.selectedComponent = step;
        }
        },
        components: {
            manageTransferInstrumentComponent,
            createTransferInstrumentComponent
        }
    }

    // export default {
    //     data() {
    //         return {
    //             dynamicComponent: "manageTransferInstrumentComponent"
    //         }
    //     },
    //     methods: {
    //         changeStep(step){
    //             this.selectedComponent = step;
    //         }
    //     },
    //     components: {
    //         createTransferInstrumentComponent,
    //         manageTransferInstrumentComponent
    //     }
    // }
</script>
