<template>
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead class="thead-light">
          <tr>
            <th 
              v-for="column in columns"
              @click="sortByColumn(column)"
              class="sortable"
            >
              {{ column }}
              <span v-if="sortKey === column">
                {{ sortDirection === 'asc' ? '▲' : '▼' }}
              </span>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="row in sortedData" :key="row.id" @click="() => action(row.id)">
            <td v-for="column in columns">
              {{row[column]}}
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  export default {
    name: "DynamicListComponent",
    props: {
      columns: {
        type: Array,
        required: true,
      },
      data: {
        type: Array,
        required: true,
      },
      action: {
        type: Function,
        required: true,
      }
    },
    data() {
      return {
        sortKey: null,
        sortDirection: 'asc',
      };
    },
    mounted() {
    console.log('Component has been mounted');
    // console.log(this.columns);
    // console.log(this.data);
    console.log(this.action);
  },
    computed: {
      sortedData() {
        if (!this.sortKey) return this.data;
        
        return [...this.data].sort((a, b) => {
          let result = 0;
          if (a[this.sortKey] > b[this.sortKey]) {
            result = 1;
          } else if (a[this.sortKey] < b[this.sortKey]) {
            result = -1;
          }
  
          return this.sortDirection === 'asc' ? result : -result;
        });
      },
    },
    methods: {
      sortByColumn(key) {
        if (this.sortKey === key) {
          this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
          this.sortKey = key;
          this.sortDirection = 'asc';
        }
      },
    },
  };
  </script>
  
  <style scoped>
  .sortable {
    cursor: pointer;
  }
  
  .sortable span {
    margin-left: 5px;
  }
  </style>
  