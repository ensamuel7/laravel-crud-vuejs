import store from '../.././store'
import axios from 'axios'

// SET THE HEADERS FOR REACH REQUEST
store.subscribe(( mutation ) => {
    switch(mutation.type) {
        case 'auth/SET_MY_TOKEN':
            if(mutation.payload) {
                axios.defaults.headers.common['Authorization'] = `Bearer ${mutation.payload}`
                localStorage.setItem('token', mutation.payload)
            } else {
                axios.defaults.headers.common['Authorization'] = ''
                localStorage.removeItem('token', mutation.payload)
            }

        break;
    }
}) 