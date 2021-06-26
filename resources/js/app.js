require('./bootstrap')
import vue from 'vue'
window.Vue = vue

import App from './components/App.vue'
import VueRouter from 'vue-router'
import VueAxios from 'vue-axios'
import axios from 'axios'
import store from './store'
import {routes} from './routes'
require('./store/modules/subscriber')
 
Vue.use(VueRouter)
Vue.use(VueAxios, axios)

const router = new VueRouter({
    mode: 'history',
    routes: routes
})

router.beforeEach((to, from, next) => {
    if(to.meta.requiresAuth) {
        if(!store.getters['auth/authenticated']){
            return next({
                name: 'login'
            })
        } else {
            next()
        }
    } else {
        next()
    }
})

// ONLY RENDER THE VIEW AFTER THE PROMISE IS RETURNED
store.dispatch('auth/letsTry', localStorage.getItem('token')).then(() => {
    const app = new Vue({
        el: '#app',
        router: router,
        store,
        render: h => h(App),
    })
})
