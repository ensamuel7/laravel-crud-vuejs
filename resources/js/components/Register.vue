<template>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="login-form bg-light mt-4 p-4">

                    <div v-if="errors" >
                        <div v-for="(v, k) in errors" :key="k">
                            <p v-for="error in v" :key="error" class="text-danger">
                            {{ error }}
                            </p>
                        </div>
                    </div>
                    
                    <form @submit.prevent="submit">
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" v-model="form.name">
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" v-model="form.email">
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="form-group">
                                            <label>Password <small>Min. 6 Characters</small></label>
                                            <input type="password" class="form-control" v-model="form.password">
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="form-group">
                                            <label>Password Confirmation</label>
                                            <input type="password" class="form-control" v-model="form.password_confirmation">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Register</button>
                                    </div>
                                </div>                        
                            </form>
                    <hr class="mt-4">
                    <div class="col-12">
                        <p class="text-center mb-0">Already registered? 
                            <router-link :to='{name:"login"}' >Login Now</router-link>
                            </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"register",
    data(){
        return {
            form:{
                name: "",
                email: "",
                password:"",
                password_confirmation: "",
            },
            errors: null
        }
    },
    methods:{
        async submit(){
            await this.axios.post('/api/auth/register',this.form).then(response=>{
                this.$router.push({name:"login"})
            }).catch(error=>{
                this.errors = error.response.data.errors
            })
        }
    }
}
</script>