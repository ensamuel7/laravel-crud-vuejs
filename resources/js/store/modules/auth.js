import axios from 'axios'

export default {
    namespaced: true,
    state: {
        token: null,
        user: null,//object when filled
    },

    mutations: {
        SET_MY_TOKEN (state, token) {
            state.token = token
        },
        SET_ME_USER (state, data) {
            state.user = data
        }
    },

    // HELP READ INFORMATION FROM OUR STATE
    getters: {
        authenticated( state ) {
            return state.token && state.user
        },
        user( state ) {
            return state.user
        },
        userId( state ) {
            return state.user.id
        }
    },

    actions: {
        async logIn({ dispatch }, credentials) {
            await axios.post('/api/auth/login',credentials).then( response => {
                return dispatch('letsTry', response.data.access_token) // pass token
            }).catch( error => {
                //console.log(error)
            }) 
        },

        // TRY TO AUTHENTICATE AND SEE IF USER DATA IS AVAILABLE WITH TOKEN
        async letsTry ({ commit, state }, token) {
            if ( token ) {
                commit('SET_MY_TOKEN', token)
            }

            if(!state.token) {
                return
            }

           // SEND TOKEN WITH EACH REQUEST
            await axios.get('/api/auth/user-profile', {
                // GET USER INFO
            }).then( response => {
                commit('SET_ME_USER', response.data)
            }).catch( error => {
                commit('SET_MY_TOKEN', null)
                commit('SET_ME_USER', null)
            }) 
        },

        logOut({ commit }) {
            return axios.post('/api/auth/logout').then(() => {
                commit('SET_MY_TOKEN', null)
                commit('SET_ME_USER', null)
            })
        }


    },
}

