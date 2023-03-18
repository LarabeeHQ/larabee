<script setup>
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import { ChevronDownIcon } from "@heroicons/vue/20/solid";
import { Cog6ToothIcon } from "@heroicons/vue/24/outline";
import { onMounted, ref, computed, reactive } from "vue";
import { usePage, Link } from "@inertiajs/vue3";
const user = computed(() => usePage().props.auth.user);
const websites = user.value ? user.value.websites : [];

const emit = defineEmits(["update"]);

const { website } = defineProps({
    website: Object,
});

const online = ref(0);

const range = reactive({});

const periodFilters = [
    [
        {
            name: "Live",
            key: "live",
            group: "minute",
        },
        {
            name: "Today",
            key: "today",
            group: "hour",
        },
        {
            name: "Yesterday",
            key: "yesterday",
            group: "hour",
        },
    ],
    [
        {
            name: "This Month",
            key: "this_month",
            group: "day",
        },
        {
            name: "Last Month",
            key: "last_month",
            group: "day",
        },
    ],
    [
        {
            name: "This Year",
            key: "this_year",
            group: "month",
        },
        {
            name: "Last 12 Months",
            key: "last_12_months",
            group: "month",
        },
    ],
    [
        {
            name: "All Time",
            key: "all_time",
            group: "month",
        },
    ],
];

const setCurrentFilter = (filter) => {
    switch (filter.key) {
        case "live":
            range.key = filter.key;
            range.name = filter.name;
            range.group = "minute";
            range.date = {
                start: dayjs().format("YYYY-MM-DD"),
                end: dayjs().format("YYYY-MM-DD"),
            };
            break;

        case "today":
            range.key = filter.key;
            range.name = filter.name;
            range.group = "hour";

            range.date = {
                start: dayjs().format("YYYY-MM-DD"),
                end: dayjs().format("YYYY-MM-DD"),
            };
            break;

        case "yesterday":
            range.key = filter.key;
            range.name = filter.name;
            range.group = "hour";

            range.date = {
                start: dayjs().subtract(1, "day").format("YYYY-MM-DD"),
                end: dayjs().subtract(1, "day").format("YYYY-MM-DD"),
            };
            break;

        case "this_month":
            range.key = filter.key;
            range.name = filter.name;
            range.group = "day";
            range.date = {
                start: dayjs().startOf("month").format("YYYY-MM-DD"),
                end: dayjs().format("YYYY-MM-DD"),
            };
            break;

        case "last_month":
            range.key = filter.key;
            range.name = filter.name;
            range.group = "day";

            range.date = {
                start: dayjs()
                    .subtract(1, "month")
                    .startOf("month")
                    .format("YYYY-MM-DD"),
                end: dayjs()
                    .subtract(1, "month")
                    .endOf("month")
                    .format("YYYY-MM-DD"),
            };

            break;

        case "this_year":
            range.key = filter.key;
            range.name = filter.name;
            range.group = "month";

            range.date = {
                start: dayjs().startOf("year").format("YYYY-MM-DD"),
                end: dayjs().format("YYYY-MM-DD"),
            };
            break;

        case "last_12_months":
            range.key = filter.key;
            range.name = filter.name;
            range.group = "month";
            range.date = {
                start: dayjs().subtract(12, "month").format("YYYY-MM-DD"),
                end: dayjs().format("YYYY-MM-DD"),
            };

            break;

        case "all_time":
            range.key = filter.key;
            range.name = filter.name;
            range.group = "day";
            range.date = {
                start: dayjs("2023-01-01 00:00").format("YYYY-MM-DD"),
                end: dayjs().format("YYYY-MM-DD"),
            };
            break;

        case "custom":
            range.key = filter.key;
            range.name = filter.name;
            range.group = "day";
            break;
    }

    emit("update", range);
};

const formatDate = (date) => {
    return dayjs(date).format("YYYY-MM-DD");
};

const loadOnline = () => {
    axios
        .get(route("websites.statistics", website.id), {
            params: {
                start: range.date.start,
                end: range.date.end,
                metric: "online",
                group: range.group,
                key: range.key,
            },
        })
        .then((response) => {
            online.value = response.data;
        });
};

onMounted(() => {
    setCurrentFilter(periodFilters[0][1]);
    loadOnline();
});
</script>
<template>
    <div class="flex items-center justify-between mb-2">
        <div class="min-w-0 flex-1">
            <div class="space-x-2 xl:space-x-4 -my-px flex items-center">
                <div v-if="user">
                    <Menu as="div" class="relative inline-block text-left">
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
                                            :href="route('websites.create')"
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

                <Link :href="route('websites.edit', website.id)">
                    <Cog6ToothIcon class="h-5 w-5 text-zinc-600 stroke-2" />
                </Link>

                <div class="flex items-center space-x-1.5">
                    <div class="h-2 w-2 bg-green-500 rounded-full"></div>
                    <div
                        class="flex items-center space-x-1 text-gray-800 dark:text-white text-sm font-medium"
                    >
                        <div>{{ online }}</div>
                        <div class="hidden xl:flex">active</div>
                        <div>users</div>
                    </div>
                </div>
            </div>
        </div>

        <Menu as="div" class="relative inline-block text-left">
            <div>
                <MenuButton class="inline-flex w-full btn-dropdown">
                    {{
                        range.key == "custom"
                            ? `${formatDate(range.start)}
                            - ${formatDate(range.end)}`
                            : range.name
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
                    class="absolute right-0 z-10 mt-2 w-44 origin-top-right divide-y divide-gray-100 dark:divide-zinc-700 rounded-md bg-white dark:bg-zinc-800 shadow-lg focus:outline-none"
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
                                    key: 'custom',
                                    name: 'Custom',
                                    group: 'day',
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
                    <div v-if="range.key == 'custom'" class="py-1">
                        <MenuItem v-slot="{ active }">
                            <div class="">
                                <div>
                                    <v-date-picker
                                        v-model="range.date"
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
                                            v-slot="{ inputValue, inputEvents }"
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
                                                        v-on="inputEvents.start"
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
                                                        :value="inputValue.end"
                                                        v-on="inputEvents.end"
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
</template>
