<template>
    <div class="container mt-5">
        <div class="col-12 text-center">
            <h1>Register</h1>  
                    <div class="col-6">
                        <div class="card-body">
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
            }
        }
    },
    methods:{
        async submit(){
            await this.axios.post('/api/auth/register',this.form).then(response=>{
                if(response.data.message.length > 0) {
                    alert(response.data.message)
                    this.$router.push({name:"login"})
                }
            }).catch(error=>{
                aalert("Something went wrong, please check your inputs or account may already exist")
            })
        }
    }
}
</script>