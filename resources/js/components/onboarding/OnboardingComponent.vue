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
            <component :is="currentTab" :legalEntityId="this.legalEntityId"></component>
        </div>
    </nav>
  </template>
<script>

import TransferInstrumentContainerComponent from './transferInstrument/TransferInstrumentContainerComponent.vue';
import OnboardIndividualContainerComponent from './individual/OnboardIndividualContainerComponent.vue';

export default {
    components: {
        TransferInstrumentContainerComponent,
        OnboardIndividualContainerComponent
    },
    data() {
        return {
            currentTab: 'TransferInstrumentContainerComponent',
            legalEntityId: 'LE32CPB22322675LPTZ3VFRPB',
            tabs: [
                {
                    name: 'Payout Accounts',
                    component: 'TransferInstrumentContainerComponent'
                },
                {
                    name: 'Personal details',
                    component: 'OnboardIndividualContainerComponent'
                }
            ]
        }
    }
}
</script>
