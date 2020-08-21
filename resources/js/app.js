


import Vue from 'vue'
import VueRouter from 'vue-router'
import VueMaterial from 'vue-material'
import 'vue-material/dist/vue-material.min.css'
import 'vue-material/dist/theme/default.css'

Vue.use(VueRouter)
Vue.use(VueMaterial)

import Article from './components/ArticlesComponent'
import App from './components/AppComponent'

const router = new VueRouter({
    mode: 'history',
    hash: false,
    linkActiveClass: 'active',
    routes: [
        {
            path: '/article',
            name: 'article',
            component: Article
        },
    ],
});

router.mode = 'html5';

const app = new Vue({
    el: '#app',
    components: { App },
    template: '<app></app>',
    router,
});
