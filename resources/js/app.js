require('./bootstrap');
window.Vue = require('vue');

Vue.component('habilidades', require('./components/habilidades.vue').default);
Vue.component('locals', require('./components/locals.vue').default);
Vue.component('vagas', require('./components/vagas.vue').default);

const app = new Vue({
    el: '#app'
});
