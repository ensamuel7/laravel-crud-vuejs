const NotFound = () => import('./components/NotFound.vue' /* webpackChunkName: "resource/js/components/welcome" */)
const Welcome = () => import('./components/Welcome.vue' /* webpackChunkName: "resource/js/components/welcome" */)
const Login = () => import('./components/Login.vue' /* webpackChunkName: "resource/js/components/login" */)
const Register = () => import('./components/Register.vue' /* webpackChunkName: "resource/js/components/register" */)
const TaskList = () => import('./components/task/List.vue' /* webpackChunkName: "resource/js/components/task/list" */)
const TaskCreate = () => import('./components/task/Add.vue' /* webpackChunkName: "resource/js/components/task/add" */)
const TaskEdit = () => import('./components/task/Edit.vue' /* webpackChunkName: "resource/js/components/task/edit" */)

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Welcome
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'login',
        path: '/login',
        component: Login,
    },
    {
        name: 'taskList',
        path: '/task',
        component: TaskList,
        meta: { requiresAuth: true}
    },
    {
        name: 'taskEdit',
        path: '/task/:id/edit',
        component: TaskEdit,
        meta: { requiresAuth: true}
    },
    {
        name: 'taskAdd',
        path: '/task/add',
        component: TaskCreate,
        meta: { requiresAuth: true}
    },
    { 
        name: 'notFound',
        path: '/404', 
        component: NotFound 
    },  
    {   path: '*', 
        redirect: '/404' 
    },  
]