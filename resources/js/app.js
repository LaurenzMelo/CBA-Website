require('./bootstrap');

window.Vue = require('vue').default;


//website
Vue.component('index', require('./components/website/index.vue').default);

const app = new Vue({
    el: '#app',
});
