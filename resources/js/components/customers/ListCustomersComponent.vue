<template>
    <div>
      <h2>Customers</h2>
      <div v-if="loading">Loading data...</div>
      <div v-if="error" class="alert alert-danger">
        Error: {{ error }}
      </div>
      <div v-if="!loading && !error">
        <DynamicListComponent :columns="tableColumns" :data="tableData" :action="onRowClick" />
      </div>
    </div>
  </template>
  
  <script>
  import DynamicListComponent from '../dynamic/DynamicListComponent.vue';
  
  export default {
    components: {
        DynamicListComponent,
    },
    data() {
      return {
        tableColumns: [],
        tableData: [],
        loading: true,
        error: null,
      };
    },
    created(){
        this.fetchData();
    },
    methods: {
        async fetchData(){
          try{
                axios.get('/list/customer').then(response => {
                    this.tableData = response.data.tableData;
                    this.tableColumns = response.data.tableColumns;
                })
            }
            catch(error){
                this.error = 'Failed to load data';
            }
            finally {
                this.loading = false;
            }
        },
        onRowClick(id){
            window.location.href = `/customers/${id}`;
        },
    },
    mounted() {
      console.log('1234/');
      console.log('Parent function:', this.onRowClick); // Should log the function definition
    }
  };
  </script>
  