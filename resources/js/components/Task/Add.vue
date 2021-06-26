<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Task</h4>
                </div>
                <div class="card-body">

                    <form @submit.prevent="create">
                        
                        <div v-if="errors" >
                            <div v-for="(v, k) in errors" :key="k">
                                <p v-for="error in v" :key="error" class="text-danger">
                                {{ error }}
                                </p>
                            </div>
                        </div>

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
                                <button type="submit" class="btn btn-primary">Save</button>
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
    name:"add-task",
    data(){
        return {
            task:{
                title: "",
                description: ""
            },
            errors: null
            
        }
    },
    methods:{
        async create(){
            await axios.post('/api/task',this.task).then( response => {
                this.$router.push({name:"taskList"})
            }).catch( error => {
                this.errors = error.response.data.errors;
            })
        }
    }
}
</script>