<template>
    <main>
        <!-- COULD CREATE A COMPONENT FOR MENU -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <router-link to="/" class="navbar-brand" href="#">CRUD Task I.O</router-link>
                <div class="collapse navbar-collapse">
                    <!-- SHOW MY TASKS AND LOGOUT iF LOGGED IN -->
                    <div v-if="authenticated" class="navbar-nav">
                        <router-link v-if="authenticated" exact-active-class="active" to="/task" class="nav-item nav-link">Task List</router-link>
                        <a v-if="authenticated" @click.prevent="logOut" href="#" class="nav-item nav-link">Logout</a>
                    </div>
                    <div v-else class="navbar-nav">
                        <router-link exact-active-class="active" to="/login" class="nav-item nav-link">Login</router-link>
                        <router-link exact-active-class="active" to="/register" class="nav-item nav-link">Register</router-link>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container mt-5">
            <router-view></router-view>
        </div>
    </main>
</template>
 
<script>
    import { mapGetters, mapActions } from 'vuex'
    
    //spread into computed
    export default {
        computed: {
            ...mapGetters({
                authenticated: 'auth/authenticated',
                user: 'auth/user'
            })
        },

        methods: {
            ...mapActions({
                logOutAction: 'auth/logOut'
            }),

            logOut(){
                // REFERENCE MAP ACTION
                this.logOutAction().then(() => {
                    this.$router.replace({
                        name: 'login'
                    })
                })
            }
        }
    }
</script>