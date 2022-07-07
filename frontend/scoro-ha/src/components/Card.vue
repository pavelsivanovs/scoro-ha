<script setup>
import StatusDropdownList from './StatusDropdownList.vue'

defineProps({
    id: Number,
    name: String,
    status_id: String,
    is_project: Boolean
})
</script>

<template>
    <div class="flex-1 md:flex-initial basis-1/2 md:basis-1/3 lg:basis-1/5 p-1 lg:px-4 lg:py-3">
        <div class="bg-gray-100 rounded-2xl h-full p-4 relative">
            <div class="mb-2 pr-2">
                <p class="text-gray-400 text-right float-right ml-1">#{{ id }}</p>
                <h4 class="md:text-lg">{{ name }}</h4>
            </div>
            <status-dropdown-list
                :status_id="status_id"
                :entity_id="id"
                :is_project="is_project"
            />
        </div>
    </div>
</template>
