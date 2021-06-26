<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Task</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="update">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" v-model="task.title">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" class="form-control" v-model="task.description">
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update</button>
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
    name:"update-task",
    data(){
        return {
            task:{
                title:"",
                description:"",
                _method:"patch"
            }
        }
    },
    mounted(){
        this.showTask()
    },
    methods:{
        async showTask(){
            await axios.get(`/api/task/${this.$route.params.id}`).then( response => {

                if(response.data.authMessage === 1) {
                    this.$router.push({name:"taskList"})
                }

                const { title, description } = response.data
                this.task.title = title
                this.task.description = description
            }).catch( error => {
                if (error.response.status === 404) {
                   this.$router.push({name:"notFound"});
                }
                console.log(error)
            })
        },
        async update(){
            if(confirm("Are you happy with your changes?")){
                await axios.post(`/api/task/${this.$route.params.id}`,this.task).then( response => {

                    if(response.data.authMessage === 1) {
                        this.$router.push({name:"taskList"})
                    }

                    this.$router.push({name:"taskList"})
                }).catch( error => {
                    console.log(error)
                })
            }     
        }
    }
}
</script>