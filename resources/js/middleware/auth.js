export default (to, from, next) => {
    if (store.getters['auth/authenticated']) {
        isAuthenticated = true
    }
    if ( isAuthenticated ) {
        next()
    } else{
        next('/login')
    }
}