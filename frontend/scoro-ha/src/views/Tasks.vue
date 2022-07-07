<script setup>
import Card from '../components/Card.vue'
import { useTaskStatusesStore } from '../stores/taskStatusesStore.js'

const tasks = await fetch('http://localhost:8000/api/tasks')
    .then(res => res.json())
    .then(res => res.data)
    .catch(err => console.error('Caught an error while fetching tasks', err))

const taskStatuses = useTaskStatusesStore()
await taskStatuses.initialize()
</script>

<template>
    <main>
        <div class="card-wrapper">
            <card
                v-for="task in tasks"
                :id="task.event_id"
                :name="task.event_name"
                :status_id="task.status"
                :is_project="false"
            />
        </div>
    </main>
</template>

<style>
main {
    @apply grow p-4 md:p-8
}

.card-wrapper {
    @apply flex flex-row flex-wrap mx-auto max-w-7xl
}
</style>
