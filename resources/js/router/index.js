import Vue from 'vue'
import Router from 'vue-router'
import habilidades from './components/habilidades.vue'
import locals from './components/locals.vue'
import vagas from './components/vagas.vue'

Vue.use(Router)

export default new Router({
    routes: [
        {
            path: '/habilidades',
            name: 'habilidades',
            component: habilidades,

            path: '/locals',
            name: 'locals',
            component: locals,

            path: '/vagas',
            name: 'vagas',
            component: vagas,
        }
    ]
})