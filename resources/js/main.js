import { data } from 'autoprefixer';
import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const app = Vue.createApp({
    data() {
        return {
            open: false
        };
    },
});
app.mount('#app');


