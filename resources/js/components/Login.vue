<template>
    <div class="container mt-5">
        <div class="col-12 text-center">
            <h1>Login</h1>
                <div class="col-6">
                        <div class="card-body">
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
                this.$router.push({
                    name: 'taskList',
                })
            }).catch(() => {
                consoloe.log('failed')
            })
        }
    }
}
</script>