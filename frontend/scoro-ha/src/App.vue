<script setup>
import { RouterView } from 'vue-router'
import NavBar from './components/NavBar.vue'
import FooterComponent from './components/FooterComponent.vue'
</script>

<template>
    <nav-bar />
    <Suspense>
        <template #default>
            <router-view v-slot="{ Component }">
                <transition name="fade" mode="out-in">
                    <component :is="Component" />
                </transition>
            </router-view>
        </template>

        <template #fallback>
            Loading data...
        </template>
    </Suspense>
    <footer-component />
</template>

<style>
@font-face {
    font-family: Inter;
    src: url(./assets/fonts/Inter.var.woff2)
}

body {
    min-height: 100vh;
    background-color: lightgray;
}

#app {
    background-color: lightgray;
    color: #1F2226;
    font-family: Inter, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;

    @apply flex flex-col min-h-screen align-middle justify-between
}

/* Styles for the transition animation */
.fade-enter-from, .fade-leave-to {
    opacity: 0;
}

.fade-enter-active, .fade-leave-active {
    transition: opacity 0.3s ease-out;
}
</style>
