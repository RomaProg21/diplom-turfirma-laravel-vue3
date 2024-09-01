import { createApp } from 'vue';

const app = createApp({});

import searchMain from './components/searchMain/searchMain.vue';
app.component('search-main', searchMain);

app.mount('#app');
