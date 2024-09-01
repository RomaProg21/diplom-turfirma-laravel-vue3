import { createApp } from 'vue';

const app = createApp({});

import turpackeges from './components/turpackeges/turpackeges.vue';
app.component('turpackeges-app', turpackeges);

app.mount('#app');
