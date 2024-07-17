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
            <component :is="currentTab" class="tab"></component>
        </div>
    </nav>
  </template>
<script>

import TransferInstrumentContainerComponent from './transferInstrument/TransferInstrumentContainerComponent.vue';
import ManageTransferInstrumentComponent from './transferInstrument/ManageTransferInstrumentComponent.vue'; //todo we do not want this here, jsut a dummy

export default {
    components: {
        TransferInstrumentContainerComponent,
        ManageTransferInstrumentComponent
    },
    data() {
        return {
            currentTab: 'TransferInstrumentContainerComponent',
            tabs: [
                {
                    name: 'Payout Accounts',
                    component: 'TransferInstrumentContainerComponent'
                },
                {
                    //replace this by something real
                    name: 'Manage',
                    component: 'ManageTransferInstrumentComponent'
                }
            ]
        }
    }
}
</script>
