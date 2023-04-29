<script setup>
import { Head, Link, usePage } from "@inertiajs/vue3";
import { onMounted, ref, computed, reactive } from "vue";

import AuthenticatedLayout from "@/Layouts/App/Master.vue";
import NoDataPlaceholder from "../NoDataPlaceholder.vue";
import Header from "./Header.vue";

import Source from "../Source/Index.vue";
import Page from "../Page/Index.vue";
import UniqueUser from "../UniqueUser/Index.vue";
import PageView from "../PageView/Index.vue";
import Device from "../Device/Index.vue";
import Location from "../Location/Index.vue";
import Event from "../Event/Index.vue";

const range = ref(null);

const user = computed(() => usePage().props.auth.user);

const { website } = defineProps({
    website: Object,
});

const setRange = (data) => {
    range.value = data;
};
</script>

<template>
    <Head :title="website.name" />

    <AuthenticatedLayout>
        <div v-if="website.sessions_count >= 1">
            <Header :website="website" @update="setRange" />

            <div class="space-y-4" v-if="range">
                <div class="grid grid-cols-12 gap-4">
                    <UniqueUser :dateRange="range" :website="website" />
                    <PageView :dateRange="range" :website="website" />
                </div>

                <div class="grid grid-cols-12 gap-4">
                    <Source :dateRange="range" :website="website" />
                    <Page :dateRange="range" :website="website" />
                </div>

                <div class="grid grid-cols-12 gap-4">
                    <Location :dateRange="range" :website="website" />
                    <Device :dateRange="range" :website="website" />
                </div>

                <div class="grid grid-cols-12 gap-4">
                    <Event :dateRange="range" :website="website" />
                </div>
            </div>
        </div>
        <div v-else>
            <NoDataPlaceholder :website="website" />
        </div>
    </AuthenticatedLayout>
</template>
