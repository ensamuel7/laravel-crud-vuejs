<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"taskAdd"}' class="btn btn-primary">Add New Task</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Task Board</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive"> 
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Created</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody v-if="!!tasks">
                                <tr v-for="(task,key) in tasks" :key="key">
                                    <td>{{ task.created_at }}</td>
                                    <td>{{ task.title }}</td>
                                    <td>{{ task.description }}</td>
                                    <td>
                                        <router-link :to='{name:"taskEdit",params:{id:task.id}}' class="btn btn-success">Edit</router-link>
                                        <button type="button" @click="deleteTask(task.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
    computed: {
            ...mapGetters({
                authenticated: 'auth/authenticated',
                user: 'auth/user'
            }),
    },

    name:"tasks",
    
    data(){
        return {
            tasks:[],        
        }
        
    },
    mounted(){
        this.getTasks()
    },
    methods:{
        async getTasks(){
            await axios.get('/api/task/').then( response => {
                this.tasks = response.data
            }).catch( error => {
                alert('Something went wrong..')
                this.tasks = []
            })
        },
        
        deleteTask(id){
            if(confirm("Are you sure to delete this task?")){
                axios.delete(`/api/task/${id}`).then( response => {
                    this.getTasks()
                }).catch(error=>{
                    alert('Something went wrong..')
                })
            }
        }
    }
}
</script>