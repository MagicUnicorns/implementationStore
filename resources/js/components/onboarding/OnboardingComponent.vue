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
            <component :is="currentTab" :legalEntityId="this.legalEntityId" class="tab"></component>
        </div>
    </nav>
  </template>
<script>

import TransferInstrumentContainerComponent from './transferInstrument/TransferInstrumentContainerComponent.vue';
import ManageTransferInstrumentComponent from './transferInstrument/ManageTransferInstrumentComponent.vue'; //todo we do not want this here, jsut a dummy

export default {
    components: {
        TransferInstrumentContainerComponent,
        ManageTransferInstrumentComponent //dummy replace by something we want here
    },
    data() {
        return {
            currentTab: 'TransferInstrumentContainerComponent',
            legalEntityId: 'LE3293S223225R5KZBJFS8944',
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
