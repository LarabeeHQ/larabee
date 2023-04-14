<script setup>
import { Head } from "@inertiajs/vue3";
import WebsiteLayout from "@/Layouts/Site/Master.vue";

defineProps({
    policy: String,
});
</script>

<template>
    <Head title="Privacy Policy" />

    <WebsiteLayout>
        <div class="mt-20 bg-white">
            <div class="mx-auto max-w-7xl py-16 px-6 sm:py-24 lg:px-8">
                <div class="prose min-w-full" v-html="policy" />
            </div>
        </div>
    </WebsiteLayout>
</template>
