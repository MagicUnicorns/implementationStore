<template>
    <div>
      <h2>Customers</h2>
      <div v-if="loading">Loading data...</div>
      <div v-if="error" class="alert alert-danger">
        Error: {{ error }}
      </div>
      <div v-if="!loading && !error">
        <DynamicTable :columns="tableColumns" :data="tableData" />
      </div>
    </div>
  </template>
  
  <script>
  import DynamicListComponent from './dynamic/DynamicListComponent.vue';
  
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
                const response = await axios.get('/list/customer');
                this.tableData = response.tableData;
                this.tableColumns = response.tableColumns;
            }
            catch(error){
                this.error = 'Failed to load data';
            }
            finally {
                this.loading = false;
            }
        }
    }
  };
  </script>
  