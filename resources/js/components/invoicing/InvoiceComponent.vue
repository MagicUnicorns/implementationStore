<template>
    <div>
      <h2>Rechnungsübersicht</h2>
        <ListInvoiceComponent/>
    </div>
  </template>
  
  <script>
  import ListInvoiceComponent from './ListInvoiceComponent.vue';
  
  export default {
    components: {
        ListInvoiceComponent,
    },
  };
  </script>
  