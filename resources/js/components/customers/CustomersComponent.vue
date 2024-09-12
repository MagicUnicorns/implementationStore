<template>
    <div>
      <h2>Kundenübersicht</h2>
        <ListCustomersComponent/>
    </div>
  </template>
  
  <script>
  import ListCustomersComponent from './ListCustomersComponent.vue';
  
  export default {
    components: {
        ListCustomersComponent,
    },
  };
  </script>
  