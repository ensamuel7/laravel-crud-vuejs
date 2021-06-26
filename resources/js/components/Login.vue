<template>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="login-form bg-light mt-4 p-4">
                    <form @submit.prevent="submit">
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" v-model="form.email">
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" v-model="form.password">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Login</button>
                                    </div>
                                </div>                        
                            </form>
                    <hr class="mt-4">
                    <div class="col-12">
                        <p class="text-center mb-0">Have not registered yet? 
                            <router-link :to='{name:"register"}' >Signup</router-link>
                            </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions } from 'vuex'

export default {
    name:"login",
    data(){
        return {
            form:{
                email: "",
                password:"",
            }
        }
    },
    methods:{
        ...mapActions({
            logIn: 'auth/logIn'
        }),
        submit(){
            // REFERENCE THE MAP ACTION
            this.logIn(this.form).then(() => {
                 if(store.getters['auth/authenticated']){
                    this.$router.push({
                        name: 'taskList',
                    })
                }
            }).catch(() => {
                alert("Sorry it didn't work..")
            })
        }
    }
}
</script>