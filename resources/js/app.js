import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

var app = new Vue({
    el: '#app',
    data: {
        open: false,
    }
})
