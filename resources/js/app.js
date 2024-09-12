/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp, defineAsyncComponent } from 'vue';

//import './adyenImplementation'
/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

const PaymentsBodyComponent = defineAsyncComponent(() => import('./components/PaymentsBodyComponent.vue'));
app.component('payments-body-component', PaymentsBodyComponent);

const PaymentsResponseComponent = defineAsyncComponent(() => import( './components/PaymentsResponseComponent.vue'));
app.component('payments-response-component', PaymentsResponseComponent);

const PaymentsDetailsResponseComponent = defineAsyncComponent(() => import( './components/PaymentsDetailsResponseComponent.vue'));
app.component('payments-details-response-component', PaymentsDetailsResponseComponent);

const PaymentsDetailsRequestComponent = defineAsyncComponent(() => import( './components/PaymentsDetailsRequestComponent.vue'));
app.component('payments-details-request-component', PaymentsDetailsRequestComponent);

const PaymentsComponent = defineAsyncComponent(() => import( './components/PaymentsComponent.vue'));
app.component('payments-component', PaymentsComponent);

const DropinComponent = defineAsyncComponent(() => import( './components/DropinComponent.vue'));
app.component('dropin-component', DropinComponent);

const WebhooksComponent = defineAsyncComponent(() => import( './components/WebhooksComponent.vue'));
app.component('webhooks-component', WebhooksComponent);

const OnboardingComponent = defineAsyncComponent(() => import( './components/onboarding/OnboardingComponent.vue'));
app.component('onboarding-component', OnboardingComponent);

const TestComponent = defineAsyncComponent(() => import( './components/TestComponent.vue'));
app.component('test-component', TestComponent);

const CustomersComponent = defineAsyncComponent(() => import( './components/customers/CustomersComponent.vue'));
app.component('customer-component', CustomersComponent);

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
