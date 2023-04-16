<script setup>
import { Link, Head, usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/App/Master.vue";
import Pagination from "@/Components/Pagination.vue";

const website = usePage().props.auth.user.current_website;

const { session } = defineProps({
    session: Object,
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
        <div class="grid grid-cols-5">
            <div class="col-span-3">
                <div class="card divide-y divider-gray-100">
                    <div
                        v-for="page_view in session.page_views"
                        :key="page_view.id"
                    >
                        <div></div>
                        <div>
                            {{ page_view.url }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-2">
                <div>{{ session.id }}</div>
                <div class="flex items-center space-x-2">
                    <div class="flex items-center space-x-2">
                        <img
                            :src="`https://flagcdn.com/16x12/${session.country.toLowerCase()}.png`"
                            :alt="session.country"
                        />
                        <div>{{ session.country }}</div>
                    </div>
                    <div>{{ session.browser }}</div>
                    <div>{{ session.os }}</div>
                </div>
                <div>
                    <div>First visit</div>
                    <div>
                        <div>Referrer</div>
                        <div>{{ session.first_page_view.referrer }}</div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
