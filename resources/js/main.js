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

window.Vue = require('vue').default;

Vue.component('message', require('./components/Message.vue').default);

const chat = new Vue({
    el: '#chat',
    data: {
        message: '',
        chat: {
            message: []
        }
    },
    methods: {
        send() {
            if (this.message.length != 0) {
                this.chat.message.push(this.message);
                this.message = '';
            }
        }
    },
});
