<script setup>
import { RouterLink } from 'vue-router';
</script>

<template>
    <nav class="text-lg md:text-2xl py-8 flex flex-row flex-wrap">
        <h3 class="font-bold">Scoro Home Assignment</h3>
        <div class="flex gap-4">
            <router-link
                class="router-link"
                to="/"
            >
                Tasks
            </router-link>
            <router-link
                class="router-link"
                to="/projects"
            >
                Projects
            </router-link>
        </div>
    </nav>
</template>

<style>
nav {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    gap: 20px;
}

.router-link {
    @apply underline decoration-4 decoration-transparent text-gray-600 transition
}

.router-link:hover {
    @apply decoration-yellow-500
}

.router-link-active {
    @apply decoration-yellow-500
}
</style>
