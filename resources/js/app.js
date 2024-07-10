/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

//import './adyenImplementation'
/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import PaymentsBodyComponent from './components/PaymentsBodyComponent.vue';
app.component('payments-body-component', PaymentsBodyComponent);

import PaymentsResponseComponent from './components/PaymentsResponseComponent.vue';
app.component('payments-response-component', PaymentsResponseComponent);

import PaymentsDetailsResponseComponent from './components/PaymentsDetailsResponseComponent.vue';
app.component('payments-details-response-component', PaymentsDetailsResponseComponent);

import PaymentsDetailsRequestComponent from './components/PaymentsDetailsRequestComponent.vue';
app.component('payments-details-request-component', PaymentsDetailsRequestComponent);

import PaymentsComponent from './components/PaymentsComponent.vue';
app.component('payments-component', PaymentsComponent);

import DropinComponent from './components/DropinComponent.vue';
app.component('dropin-component', DropinComponent);

import WebhooksComponent from './components/WebhooksComponent.vue';
app.component('webhooks-component', WebhooksComponent);

import OnboardingComponent from './components/OnboardingComponent.vue';
app.component('onboarding-component', OnboardingComponent);

import TransferInstrumentContainerComponent from './components/TransferInstrumentContainerComponent.vue';
app.component('transfer-instrument-container-component', TransferInstrumentContainerComponent)

import ManageTransferInstrumentComponent from './components/ManageTransferInstrumentComponent.vue';
app.component('manage-transfer-instrument-component', ManageTransferInstrumentComponent)

import CreateTransferInstrumentComponent from './components/CreateTransferInstrumentComponent.vue';
app.component('create-transfer-instrument-component', CreateTransferInstrumentComponent)
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
