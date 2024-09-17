<template>
    <div>
      <h2>Patientenübersicht</h2>
        <ListPatientsComponent/>
    </div>
  </template>
  
  <script>
  import ListPatientsComponent from './ListPatientsComponent.vue';
  
  export default {
    components: {
      ListPatientsComponent,
    },
  };
  </script>
  