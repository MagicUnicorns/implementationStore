<template>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button
                v-for="tab in tabs"
                :key="tab.component"
                :class="['nav-link', { active: currentTab === tab.component }]"
                @click="currentTab = tab.component"
                role="tab" data-bs-target="#nav-home" data-bs-toggle="tab" type="button" aria-controls="nav-home" aria-selected="true">
                {{ tab.name }}
            </button>
            <component :is="currentTab" :balanceAccountId="this.balanceAccountId" class="tab"></component>
        </div>
    </nav>
  </template>
<script>

import TransactionListComponent from './transactions/TransactionListComponent.vue';

export default {
    components: {
        TransactionListComponent,
    },
    data() {
        return {
            currentTab: 'TransactionListComponent',
            balanceAccountId: 'BA3295522322845LC2BMP73PM',
            tabs: [
                {
                    name: 'Transaction list',
                    component: 'TransactionListComponent'
                },
                // {
                //     //replace this by something real
                //     name: 'Reports',
                //     component: 'ReportsComponent'
                // }
            ]
        }
    }
}
</script>
