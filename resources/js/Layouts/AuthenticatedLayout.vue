<script setup>
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";

import Header from "./Header.vue";
import Banner from "@/Components/Banner.vue";

const user = computed(() => usePage().props.auth.user);
</script>

<template>
    <div>
        <Header v-if="user" />
        <Banner v-if="user" />
        <div class="min-h-screen bg-zinc-100 dark:bg-zinc-900">
            <main class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-4 py-12">
                <slot />
            </main>
        </div>
    </div>
</template>
