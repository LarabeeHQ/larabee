<script setup>
import { Link, Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/App/Master.vue";
import Pagination from "@/Components/Pagination.vue";

const { website, sessions } = defineProps({
    sessions: Object,
    website: Object,
});

const formatDate = (date) => {
    return dayjs(date).format("MMMM D, YYYY h:mm A");
};
</script>
<template>
    <AuthenticatedLayout>
        <Head title="Users" />

        <div class="min-w-0 flex-1 mb-4">
            <div class="-my-px">
                <div class="text-4xl font-bold text-black dark:text-white">
                    Users
                </div>
                <div class="text-sm font-medium text-zinc-800 dark:text-white">
                    {{ website.domain }}
                </div>
            </div>
        </div>
        <div class="">
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div
                        class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"
                    >
                        <div
                            class="overflow-hidden shadow rounded-md border border-zinc-200 dark:border-zinc-700"
                        >
                            <table class="table">
                                <thead class="table-thead">
                                    <tr>
                                        <th scope="col" class="table-th">
                                            Name
                                        </th>
                                        <th scope="col" class="table-th">
                                            Country
                                        </th>
                                        <th scope="col" class="table-th">
                                            Last Seen
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="table-tbody">
                                    <tr
                                        v-for="session in sessions.data"
                                        :key="session.id"
                                    >
                                        <td class="table-td">
                                            {{ session.id }}
                                        </td>
                                        <td
                                            class="table-td flex items-center space-x-2"
                                        >
                                            <img
                                                :src="`https://flagcdn.com/16x12/${session.country.toLowerCase()}.png`"
                                                :alt="session.country"
                                            />
                                            <div>{{ session.country }}</div>
                                        </td>
                                        <td class="table-td">
                                            {{ formatDate(session.updated_at) }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <Pagination :data="sessions" />
        </div>
    </AuthenticatedLayout>
</template>
