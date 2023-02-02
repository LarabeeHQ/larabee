<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, usePage } from "@inertiajs/vue3";
import { onMounted, ref, computed, onBeforeMount, watch } from "vue";

const data = ref(null);

const range = ref({
    start: dayjs().subtract(1, "month").format("YYYY-MM-DD"),
    end: dayjs().format("YYYY-MM-DD"),
});

const website = computed(() => usePage().props.website);

const loadData = async () => {
    return await axios
        .get(route("websites.load-data", website.value.id), {
            params: {
                start: range.value.start,
                end: range.value.end,
            },
        })
        .then((response) => {
            data.value = response.data;
        });
};

onMounted(() => {
    loadData();
});

watch(range, (value) => {
    range.value.start = dayjs(value.start).format("YYYY-MM-DD");
    range.value.end = dayjs(value.end).format("YYYY-MM-DD");
    loadData();
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div v-if="data">
            <div>
                <div
                    class="border-b border-gray-200 px-4 py-2 flex items-center justify-between sm:px-6 lg:px-8"
                >
                    <div class="min-w-0 flex-1">
                        <h1
                            class="text-lg font-medium leading-6 text-black sm:truncate"
                        >
                            Dashboard
                        </h1>
                    </div>
                    <div class="mt-4 flex sm:mt-0 sm:ml-4">
                        <v-date-picker
                            v-model="range"
                            is-range
                            color="purple"
                            mode="date"
                            title-position="center"
                            :popover="{ visibility: 'click' }"
                            timezone="UTC"
                        >
                            <template v-slot="{ inputValue, inputEvents }">
                                <div
                                    class="flex justify-start sm:justify-center items-center space-x-2"
                                >
                                    <input
                                        :value="inputValue.start"
                                        v-on="inputEvents.start"
                                        class="border px-2 py-1 w-32 rounded focus:outline-none focus:border-indigo-300"
                                    />
                                    <svg
                                        class="w-4 h-4 mx-2"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"
                                        />
                                    </svg>
                                    <input
                                        :value="inputValue.end"
                                        v-on="inputEvents.end"
                                        class="border px-2 py-1 w-32 rounded focus:outline-none focus:border-indigo-300"
                                    />
                                </div>
                            </template>
                        </v-date-picker>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        Last 30 days
                    </h3>
                    <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-4">
                        <div
                            class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6"
                        >
                            <dt
                                class="truncate text-sm font-medium text-gray-500"
                            >
                                Sessions
                            </dt>
                            <dd
                                class="mt-1 text-3xl font-semibold tracking-tight text-gray-900"
                            >
                                {{ data.sessions }}
                            </dd>
                        </div>

                        <div
                            class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6"
                        >
                            <dt
                                class="truncate text-sm font-medium text-gray-500"
                            >
                                Page Views
                            </dt>
                            <dd
                                class="mt-1 text-3xl font-semibold tracking-tight text-gray-900"
                            >
                                {{ data.page_views }}
                            </dd>
                        </div>

                        <div
                            class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6"
                        >
                            <dt
                                class="truncate text-sm font-medium text-gray-500"
                            >
                                Bounce Rate
                            </dt>
                            <dd
                                class="mt-1 text-3xl font-semibold tracking-tight text-gray-900"
                            >
                                0
                            </dd>
                        </div>

                        <div
                            class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6"
                        >
                            <dt
                                class="truncate text-sm font-medium text-gray-500"
                            >
                                Session duration
                            </dt>
                            <dd
                                class="mt-1 text-3xl font-semibold tracking-tight text-gray-900"
                            >
                                0
                            </dd>
                        </div>
                    </dl>
                </div>

                <div class="grid grid-cols-10 gap-4">
                    <div class="col-span-6 bg-white p-4">
                        <div>Sources</div>
                        <div class="mt-4">
                            <ul>
                                <li v-for="page in data.referrer" :key="page">
                                    <div
                                        class="flex items-center justify-between"
                                    >
                                        <div>
                                            {{
                                                page.referrer
                                                    ? page.referrer
                                                    : "(None)"
                                            }}
                                        </div>
                                        <div>{{ page.total }}</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-span-4 bg-white p-4">
                        <div>Pages</div>
                        <div class="mt-4">
                            <ul>
                                <li v-for="page in data.pages" :key="page">
                                    <div
                                        class="flex items-center justify-between"
                                    >
                                        <div>{{ page.url }}</div>
                                        <div>{{ page.total }}</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-10 gap-4">
                    <div class="col-span-6 bg-white p-4">
                        <div>Locations</div>
                    </div>
                    <div class="col-span-4 bg-white p-4">
                        <div>devices</div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
