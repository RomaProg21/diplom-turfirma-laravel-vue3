import { createApp } from 'vue';

const app = createApp({});

import tour from './components/tour/tour.vue';
app.component('tour-app', tour);

app.mount('#app');
