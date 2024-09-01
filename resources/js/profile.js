import { createApp } from 'vue';

const app = createApp({});

import profile from './components/profile/profile.vue';
app.component('profile-app', profile);

app.mount('#app');
