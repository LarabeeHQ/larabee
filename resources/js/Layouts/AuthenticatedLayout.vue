<script setup>
import Header from "./Header.vue";
import Banner from "@/Components/Banner.vue";
</script>

<template>
    <!-- <Header /> -->
    <!-- <Banner /> -->
    <div class="min-h-screen bg-zinc-100 dark:bg-zinc-900">
        <main class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-4 py-12">
            <slot />
        </main>
    </div>
</template>
