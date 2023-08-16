<script setup>
import { ref } from "vue";
import { Link, Head, usePage, useForm } from "@inertiajs/vue3";

import AuthenticatedLayout from "@/Layouts/App/Master.vue";

import { ChevronLeftIcon } from "@heroicons/vue/24/outline";

import UserCardInfo from "./Partials/UserCardInfo.vue";
import UserTimeline from "./Partials/UserTimeline.vue";

const website = usePage().props.auth.user.current_website;

const { session, events } = defineProps({
    session: Object,
    eventDates: Object,
});
</script>
<template>
    <AuthenticatedLayout>
        <Head title="Users" />

        <div class="min-w-0 flex-1 mb-4">
            <div class="">
                <Link
                    class="-ml-3 inline-flex items-center font-medium space-x-1 mb-2 hover:bg-white dark:hover:bg-zinc-800 rounded-md px-2.5 py-1.5"
                    :href="route('users.index')"
                >
                    <ChevronLeftIcon
                        class="h-4 w-4 stroke-2 text-black dark:text-white"
                    />
                    <div class="text-black dark:text-white">Users</div>
                </Link>

                <h1 class="h1" v-if="session.name">{{ session.name }}</h1>
                <h1 class="h1" v-else-if="session.email">
                    {{ session.email }}
                </h1>
                <h1 class="h1" v-else>
                    {{ session.id }}
                </h1>
            </div>
        </div>
        <div class="grid grid-cols-5 gap-8">
            <UserTimeline :eventDates="eventDates" />
            <UserCardInfo :session="session" />
        </div>
    </AuthenticatedLayout>
</template>
