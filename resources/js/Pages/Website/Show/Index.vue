<script setup>
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import { ChevronDownIcon } from "@heroicons/vue/20/solid";

import SnippetCode from "./SnippetCode.vue";

import Source from "./Source/Index.vue";
import Page from "./Page/Index.vue";

import Overview from "./Overview/Index.vue";
import Device from "./Device/Index.vue";
import Location from "./Location/Index.vue";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, usePage } from "@inertiajs/vue3";
import { onMounted, ref, computed, onBeforeMount, watch } from "vue";

const user = usePage().props.auth.user;
const websites = user.websites;
const website = computed(() => usePage().props.website);
const data = ref(null);
const online = ref(0);

const range = ref({
    start: dayjs().subtract(1, "month").format("YYYY-MM-DD"),
    end: dayjs().format("YYYY-MM-DD"),
});

const periodFilters = [
    [
        {
            name: "Live",
            value: "live",
        },
        {
            name: "Today",
            value: "today",
        },
        {
            name: "Yesterday",
            value: "yesterday",
        },
    ],
    [
        {
            name: "This Month",
            value: "this_month",
        },
        {
            name: "Last Month",
            value: "last_moth",
        },
    ],
    [
        {
            name: "This Year",
            value: "this_year",
        },
        {
            name: "Last 12 Months",
            value: "last_12_months",
        },
    ],
    [
        {
            name: "All Time",
            value: "all_time",
        },
    ],
];

const selectedFilter = ref({
    name: "Today",
    value: "today",
});

const setCurrentFilter = (filter) => {
    selectedFilter.value = filter;

    switch (filter.value) {
        case "live":
            break;

        case "today":
            range.value.start = dayjs().format("YYYY-MM-DD");
            range.value.end = dayjs().format("YYYY-MM-DD");
            break;

        case "yesterday":
            range.value.start = dayjs().subtract(1, "day").format("YYYY-MM-DD");
            range.value.end = dayjs().subtract(1, "day").format("YYYY-MM-DD");
            break;

        case "this_month":
            range.value.start = dayjs().startOf("month").format("YYYY-MM-DD");
            range.value.end = dayjs().format("YYYY-MM-DD");
            break;

        case "last_moth":
            range.value.start = dayjs()
                .subtract(1, "month")
                .startOf("month")
                .format("YYYY-MM-DD");
            range.value.end = dayjs()
                .subtract(1, "month")
                .endOf("month")
                .format("YYYY-MM-DD");
            break;

        case "this_year":
            range.value.start = dayjs().startOf("year").format("YYYY-MM-DD");
            range.value.end = dayjs().format("YYYY-MM-DD");
            break;

        case "last_12_months":
            range.value.start = dayjs()
                .subtract(12, "month")
                .format("YYYY-MM-DD");
            range.value.end = dayjs().format("YYYY-MM-DD");
            break;

        case "all_time":
            range.value.start = dayjs("2023-01-01 00:00").format("YYYY-MM-DD"); // year of launch
            range.value.end = dayjs().format("YYYY-MM-DD");
            break;
    }
};

const formatDate = (date) => {
    return dayjs(date).format("YYYY-MM-DD");
};

const loadOnline = () => {
    axios
        .get(route("websites.statistics", website.value.id), {
            params: {
                start: range.value.start,
                end: range.value.end,
                metric: "online",
            },
        })
        .then((response) => {
            online.value = response.data;
        });
};

onMounted(() => {
    loadOnline();
});
</script>

<template>
    <Head :title="`${website.name} - Analytics`" />

    <AuthenticatedLayout>
        <div>index</div>
    </AuthenticatedLayout>
</template>
