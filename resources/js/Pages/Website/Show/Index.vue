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
const websites = user ? user.websites : [];
const website = computed(() => usePage().props.website);
const online = ref(0);

const render = ref(false);

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

    setTimeout(() => {
        render.value = true;
    }, 3000);
});
</script>

<template>
    <Head :title="`${website.name} - Analytics`" />

    <AuthenticatedLayout>
        <div v-if="website.sessions_count >= 1">
            <div class="flex items-center justify-between mb-2">
                <div class="min-w-0 flex-1">
                    <div
                        class="hidden space-x-4 sm:-my-px sm:flex items-center"
                    >
                        <div v-if="user">
                            <Menu
                                as="div"
                                class="relative inline-block text-left"
                            >
                                <div>
                                    <MenuButton class="w-full btn-dropdown">
                                        {{ website.name }}
                                        <ChevronDownIcon
                                            class="-mr-1 ml-2 h-5 w-5"
                                            aria-hidden="true"
                                        />
                                    </MenuButton>
                                </div>

                                <transition
                                    enter-active-class="transition ease-out duration-100"
                                    enter-from-class="transform opacity-0 scale-95"
                                    enter-to-class="transform opacity-100 scale-100"
                                    leave-active-class="transition ease-in duration-75"
                                    leave-from-class="transform opacity-100 scale-100"
                                    leave-to-class="transform opacity-0 scale-95"
                                >
                                    <MenuItems
                                        class="absolute left-0 z-10 mt-2 w-64 origin-top-left divide-y divide-gray-100 dark:divide-zinc-700 rounded-md bg-white dark:bg-zinc-800 shadow-lg focus:outline-none"
                                    >
                                        <div class="py-1">
                                            <MenuItem
                                                v-for="website in websites"
                                                :key="website"
                                                v-slot="{ active }"
                                            >
                                                <Link
                                                    :href="
                                                        route('websites.show', {
                                                            id: website.id,
                                                        })
                                                    "
                                                    class="block px-4 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-zinc-700"
                                                >
                                                    <div
                                                        class="text-sm font-semibold text-zinc-700 dark:text-white"
                                                    >
                                                        {{ website.name }}
                                                    </div>
                                                    <div
                                                        class="text-xs font-medium text-zinc-400 dark:text-zinc-500"
                                                    >
                                                        {{ website.domain }}
                                                    </div>
                                                </Link>
                                            </MenuItem>
                                        </div>
                                        <div class="py-1">
                                            <MenuItem v-slot="{ active }">
                                                <Link
                                                    :href="
                                                        route('websites.create')
                                                    "
                                                    class="text-gray-700 dark:text-white block px-4 py-2 text-sm cursor-pointer hover:bg-gray-100 dark:hover:bg-zinc-700"
                                                >
                                                    Add Website
                                                </Link>
                                            </MenuItem>
                                        </div>
                                    </MenuItems>
                                </transition>
                            </Menu>
                        </div>
                        <div class="flex items-center space-x-1.5">
                            <div
                                class="h-2 w-2 bg-green-500 rounded-full"
                            ></div>
                            <div
                                class="text-gray-800 dark:text-white text-sm font-medium"
                            >
                                {{ online }} active users
                            </div>
                        </div>
                    </div>
                </div>

                <Menu as="div" class="relative inline-block text-left">
                    <div>
                        <MenuButton class="inline-flex w-full btn-dropdown">
                            {{
                                selectedFilter.value == "custom"
                                    ? `${formatDate(range.start)}
                            - ${formatDate(range.end)}`
                                    : selectedFilter.name
                            }}
                            <ChevronDownIcon
                                class="-mr-1 ml-2 h-5 w-5"
                                aria-hidden="true"
                            />
                        </MenuButton>
                    </div>

                    <transition
                        enter-active-class="transition ease-out duration-100"
                        enter-from-class="transform opacity-0 scale-95"
                        enter-to-class="transform opacity-100 scale-100"
                        leave-active-class="transition ease-in duration-75"
                        leave-from-class="transform opacity-100 scale-100"
                        leave-to-class="transform opacity-0 scale-95"
                    >
                        <MenuItems
                            class="absolute right-0 z-10 mt-2 w-52 origin-top-right divide-y divide-gray-100 dark:divide-zinc-700 rounded-md bg-white dark:bg-zinc-800 shadow-lg focus:outline-none"
                        >
                            <div
                                v-for="periodFilter in periodFilters"
                                :key="periodFilter"
                                class="p-1"
                            >
                                <MenuItem
                                    v-for="filter in periodFilter"
                                    :key="filter"
                                    @click="setCurrentFilter(filter)"
                                    v-slot="{ active }"
                                >
                                    <div
                                        class="text-gray-700 dark:text-white block px-4 py-2 text-sm cursor-pointer hover:bg-gray-100 dark:hover:bg-zinc-700"
                                    >
                                        {{ filter.name }}
                                    </div>
                                </MenuItem>
                            </div>

                            <div class="p-1">
                                <MenuItem
                                    @click.prevent="
                                        setCurrentFilter({
                                            name: 'Custom',
                                            value: 'custom',
                                        })
                                    "
                                    v-slot="{ active }"
                                >
                                    <div
                                        class="text-gray-700 dark:text-white block px-4 py-2 text-sm cursor-pointer hover:bg-gray-100 dark:hover:bg-zinc-700"
                                    >
                                        Custom
                                    </div>
                                </MenuItem>
                            </div>

                            <div
                                v-if="selectedFilter.value == 'custom'"
                                class="py-1"
                            >
                                <MenuItem v-slot="{ active }">
                                    <div class="">
                                        <div>
                                            <v-date-picker
                                                v-model="range"
                                                is-range
                                                color="black"
                                                is-dark
                                                mode="date"
                                                title-position="center"
                                                :popover="{
                                                    visibility: 'click',
                                                }"
                                                timezone="UTC"
                                            >
                                                <template
                                                    v-slot="{
                                                        inputValue,
                                                        inputEvents,
                                                    }"
                                                >
                                                    <div class="flex flex-col">
                                                        <div class="px-4 py-2">
                                                            <div
                                                                class="text-xs dark:text-gray-300 font-medium mb-1"
                                                            >
                                                                Start date
                                                            </div>
                                                            <input
                                                                :value="
                                                                    inputValue.start
                                                                "
                                                                v-on="
                                                                    inputEvents.start
                                                                "
                                                                class="px-2 py-1 w-full rounded focus:outline-none bg-gray-100 dark:bg-zinc-700 dark:text-white"
                                                            />
                                                        </div>

                                                        <div class="px-4 py-2">
                                                            <div
                                                                class="text-xs dark:text-gray-300 font-medium mb-1"
                                                            >
                                                                End date
                                                            </div>
                                                            <input
                                                                :value="
                                                                    inputValue.end
                                                                "
                                                                v-on="
                                                                    inputEvents.end
                                                                "
                                                                class="px-2 py-1 w-full rounded focus:outline-none bg-gray-100 dark:bg-zinc-700 dark:text-white"
                                                            />
                                                        </div>
                                                    </div>
                                                </template>
                                            </v-date-picker>
                                        </div>
                                    </div>
                                </MenuItem>
                            </div>
                        </MenuItems>
                    </transition>
                </Menu>
            </div>

            <div class="space-y-4">
                <Overview
                    key="overviewIndex"
                    :dateRange="range"
                    :website="website"
                />

                <div class="grid grid-cols-12 gap-4">
                    <Source
                        key="sourceIndex"
                        :dateRange="range"
                        :website="website"
                    />
                    <Page
                        key="pageIndex"
                        :dateRange="range"
                        :website="website"
                    />
                </div>

                <div class="grid grid-cols-12 gap-4">
                    <Location
                        key="locationIndex1"
                        :dateRange="range"
                        :website="website"
                    />
                    <Device
                        key="deviceIndex"
                        :dateRange="range"
                        :website="website"
                    />
                </div>
            </div>
        </div>
        <div v-else class="space-y-4">
            <div class="card p-6">
                <div class="flex items-center">
                    <div class="flex absolute h-4 w-4">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"
                        ></span
                        ><span
                            class="relative inline-flex rounded-full h-4 w-4 bg-green-500"
                        ></span>
                    </div>
                    <div
                        class="ml-7 flex items-center space-x-1 text-gray-800 dark:text-white text-sm font-medium"
                    >
                        <div>Waiting for first pageview on</div>
                        <div class="font-bold">{{ website.domain }}</div>
                    </div>
                </div>
            </div>

            <div v-if="render" class="card p-6">
                <div class="text-gray-800 dark:text-white">
                    <div class="text-xl font-semibold mb-1">
                        Your javascript code
                    </div>
                    <div class="text-base font-medium">
                        Paste this snippet in the &lt;head&gt; of your website.
                    </div>
                    <SnippetCode key="snippetIndex" :website="website" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
