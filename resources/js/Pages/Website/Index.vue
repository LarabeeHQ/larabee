<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, usePage } from "@inertiajs/vue3";
import { onMounted, ref, computed, onBeforeMount, watch } from "vue";

const user = usePage().props.auth.user;
const websites = user.websites;
</script>

<template>
    <Head title="Websites" />

    <AuthenticatedLayout>
        <div class="grid grid-cols-4 gap-4">
            <Link
                as="div"
                v-for="website in websites"
                :key="website.id"
                class="cursor-pointer border-zinc-300 dark:border-zinc-800 bg-white dark:bg-zinc-900 text-zinc-700 dark:text-white p-4 rounded-md"
                :href="route('websites.show', website.id)"
            >
                <div clas>
                    {{ website.name }}
                </div>
                <div>{{ website.sessions_count }} visitors in last 24h</div>
            </Link>
        </div>
    </AuthenticatedLayout>
</template>
