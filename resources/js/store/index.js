import Vuex from 'vuex'
import Vue from 'vue'
import auth from './modules/auth'
Vue.config.devtools = true
Vue.use(Vuex)


export default new Vuex.Store({
    state: {
        //state of app
    },
    mutations: {
        //update the state
    },

    actions: {

        //commit mutations
    },

    modules: {
        //specific modules
        auth
    }
})

