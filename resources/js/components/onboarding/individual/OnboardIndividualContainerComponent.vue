<template>
    <manageIndividualComponent :legalEntityId="this.legalEntityId"></manageIndividualComponent>

    <manageTermsOfServiceComponent :legalEntityId="this.legalEntityId"></manageTermsOfServiceComponent>

    <!-- <component :is=manageTermsOfServiceComponent :legalEntityId="this.legalEntityId"></component> -->


</template> 

<script>
    import manageIndividualComponent from "./ManageIndividualComponent.vue"
    import manageTermsOfServiceComponent from "./ManageTermsOfServiceComponent.vue";

    export default {
        data() {
            return {
                // selectedComponent: "manageIndividualComponent",
            }
        },
        props: {
            legalEntityId: String,
        },
        created(){
            // console.log(this.legalEntityId)
            // console.log("123523")
        },
        methods: {
        // changeStep(step){
        //     this.selectedComponent = step;
        // }
        },
        components: {
            manageIndividualComponent,
            manageTermsOfServiceComponent
        }
    }
</script>
