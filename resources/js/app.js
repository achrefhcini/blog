


import Vue from 'vue'
import VueRouter from 'vue-router'
import VueMaterial from 'vue-material'
import 'vue-material/dist/vue-material.min.css'
import 'vue-material/dist/theme/default.css'

Vue.use(VueRouter)
Vue.use(VueMaterial)

import Articles from './components/ArticlesComponent'
import Article from './components/ArticleComponent'

import App from './components/AppComponent'

const router = new VueRouter({
    mode: 'history',
    hash: false,
    linkActiveClass: 'active',
    routes: [
        {
            path: '/articles',
            name: 'articles',
            component: Articles
        },
        {
            path: '/article/:id',
            name: 'article',
            component: Article
        },
        {
            path: '*', redirect: '/articles'
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
