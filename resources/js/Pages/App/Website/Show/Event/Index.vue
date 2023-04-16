<script setup>
import { ref } from "vue";
import Event from "./Event.vue";

const { dateRange, website } = defineProps({
    dateRange: Object,
    website: Object,
});
</script>

<template>
    <div class="col-span-12 lg:col-span-6 card p-4 min-h-[450px]">
        <div class="flex items-center justify-between">
            <div
                class="capitalize text-base font-semibold text-black dark:text-white"
            >
                Events
            </div>
        </div>

        <div class="mt-4">
            <Event key="events" :dateRange="dateRange" :website="website" />
        </div>
    </div>
</template>
