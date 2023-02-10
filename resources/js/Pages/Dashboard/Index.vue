<script setup>
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import { ChevronDownIcon } from "@heroicons/vue/20/solid";

import Source from "./Source/Index.vue";
import Page from "./Page/Index.vue";

import Overview from "./Overview/Index.vue";
import Device from "./Device/Index.vue";
import Location from "./Location/Index.vue";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, usePage } from "@inertiajs/vue3";
import { onMounted, ref, computed, onBeforeMount, watch } from "vue";

const website = computed(() => usePage().props.website);
const data = ref(null);

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
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div>
            <div class="flex items-center justify-between mb-2">
                <div class="min-w-0 flex-1">
                    <h1
                        class="text-lg font-medium leading-6 text-black dark:text-white sm:truncate"
                    >
                        Dashboard
                    </h1>
                </div>

                <Menu as="div" class="relative inline-block text-left">
                    <div>
                        <MenuButton
                            class="inline-flex w-full justify-center rounded-md bg-white dark:bg-zinc-800 dark:text-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none"
                        >
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
                <Overview :date-range="range" />

                <div class="grid grid-cols-12 gap-4">
                    <Source :date-range="range" />
                    <Page :date-range="range" />
                </div>

                <div class="grid grid-cols-12 gap-4">
                    <Location :date-range="range" />
                    <Device :date-range="range" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
