<template>
    <div>
      <h2>Patientenübersicht</h2>
        <ListPatientsComponent :customerId="customer_id"/>
    </div>
  </template>
  
  <script>
  import ListPatientsComponent from './ListPatientsComponent.vue';
  
  export default {
    props: {
      customer_id: {
          type: String,
          required: false
      }
    },
    components: {
      ListPatientsComponent,
    },
    // mounted() {
    //   console.log("this.customerId in patientComponent.vue");
    //   console.log(this.customer_id);
    //   console.log("end");

    // }
  };
  </script>
  