<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link :to="{ name: 'taskAdd' }" class="btn btn-primary"
                >Add New Task</router-link
            >
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Task Board</h4>
                </div>

                <div v-if="errors">
                    <div v-for="(v, k) in errors" :key="k">
                        <p v-for="error in v" :key="error" class="text-danger">
                            {{ error }}
                        </p>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody v-if="!!tasks">
                                <tr v-for="(task, key) in tasks" :key="key">
                                    <td>{{ key + 1 }}</td>
                                    <td>{{ task.title }}</td>
                                    <td>{{ task.description }}</td>
                                    <td>
                                        <router-link
                                            :to="{
                                                name: 'taskEdit',
                                                params: { id: task.id }
                                            }"
                                            class="btn-sm btn-success"
                                            >Edit</router-link
                                        >
                                        <button
                                            type="button"
                                            @click="deleteTask(task.id)"
                                            class="btn-sm btn-danger"
                                        >
                                            Delete
                                        </button>
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
import { mapGetters } from "vuex";

export default {
    name: "tasks",
    computed: {
        ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user"
        })
    },

    data() {
        return {
            tasks: [],
            errors: null
        };
    },
    mounted() {
        this.getTasks();
    },
    methods: {
        async getTasks() {
            await axios
                .get("/api/task/")
                .then(response => {
                    this.tasks = response.data;
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    this.tasks = [];
                });
        },

        deleteTask(id) {
            if (confirm("Are you sure to delete this task?")) {
                axios
                    .delete(`/api/task/${id}`)
                    .then(response => {
                        this.getTasks();
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                    });
            }
        }
    }
};
</script>
