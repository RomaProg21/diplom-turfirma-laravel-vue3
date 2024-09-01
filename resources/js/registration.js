import { createApp } from 'vue';

const app = createApp({});

import registration from './components/registration/registration.vue';
app.component('registration-app', registration);

app.mount('#app');
