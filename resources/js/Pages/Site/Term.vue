<script setup>
import { Head } from "@inertiajs/vue3";
import WebsiteLayout from "@/Layouts/Site/Master.vue";

defineProps({
    terms: String,
});
</script>

<template>
    <Head title="Terms of Service" />

    <WebsiteLayout>
        <div class="mt-20 bg-white">
            <div class="mx-auto max-w-7xl py-16 px-6 sm:py-24 lg:px-8">
                <div class="prose min-w-full" v-html="terms" />
            </div>
        </div>
    </WebsiteLayout>
</template>
