import { createRouter, createWebHistory } from 'vue-router'
import Tasks from '../views/Tasks.vue'
import Projects from '../views/Projects.vue'

const routes = [
    {
        path: '/',
        name: 'Tasks',
        component: Tasks
    },
    {
        path: '/projects',
        name: 'Projects',
        component: Projects
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
