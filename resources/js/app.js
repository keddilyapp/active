
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Use dynamic imports for better code splitting
const app = createApp({});

// Register components dynamically for code splitting
app.component('example-component', () => import('./components/ExampleComponent.vue'));

// Mount the app
app.mount('#app');
