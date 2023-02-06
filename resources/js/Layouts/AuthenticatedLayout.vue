<script setup>
import Header from "./Header.vue";
import Banner from "@/Components/banner.vue";
</script>

<template>
    <div>
        <Header />
        <Banner />
        <div class="min-h-screen bg-zinc-100 dark:bg-black">
            <main class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4 py-12">
                <slot />
            </main>
        </div>
    </div>
</template>
