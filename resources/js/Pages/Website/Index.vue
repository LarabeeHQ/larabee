<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, usePage } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { computed } from "vue";

const user = computed(() => usePage().props.auth.user);
const websites = user.value.websites;
</script>

<template>
    <Head title="Websites" />

    <AuthenticatedLayout>
        <div class="sm:flex sm:items-center mb-8">
            <div class="sm:flex-auto">
                <h1
                    class="text-2xl font-semibold text-gray-900 dark:text-white"
                >
                    Websites
                </h1>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <PrimaryButton :href="route('websites.create')">
                    Add website
                </PrimaryButton>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-4">
            <Link
                as="div"
                v-for="website in websites"
                :key="website.id"
                class="cursor-pointer card card-hover p-4"
                :href="route('websites.show', website.id)"
            >
                <div
                    class="text-base font-semibold text-zinc-800 dark:text-white mb-1"
                >
                    {{ website.name }}
                </div>
                <div
                    class="text-sm font-medium text-zinc-500 dark:text-zinc-300"
                >
                    {{ website.sessions_count }} visitors in last 24h
                </div>
            </Link>
        </div>
    </AuthenticatedLayout>
</template>
