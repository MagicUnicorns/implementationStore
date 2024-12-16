<template>
    <div>
        <h2>Einträge</h2>
        <ListPatientVisitsComponent :patientId="patient_id"/>
    </div>
</template>

<script>
import ListPatientVisitsComponent from './ListPatientVisitsComponent.vue';

export default {
    props: {
        patient_id: {
            type: String,
            required: false
        }
    },
    components: {
        ListPatientVisitsComponent,
    },
    // mounted() {
    //   console.log("this.customerId in patientComponent.vue");
    //   console.log(this.customer_id);
    //   console.log("end");

    // }
};
</script>

