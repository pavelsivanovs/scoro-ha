<script setup>
import Card from '../components/Card.vue'
import { useProjectStatusesStore } from '../stores/projectStatusesStore.js'

const projects = await fetch('http://localhost:8000/api/projects')
    .then(res => res.json())
    .then(res => res.data)
    .catch(err => console.error('Caught an error while fetching projects', err))

const projectStatuses = useProjectStatusesStore()
await projectStatuses.initialize()
</script>

<template>
    <main>
        <div class="card-wrapper">
            <card
                v-for="proj in projects"
                :id="proj.project_id"
                :name="proj.project_name"
                :status_id="proj.status"
                :is_project="true"
            />
        </div>
    </main>
</template>
