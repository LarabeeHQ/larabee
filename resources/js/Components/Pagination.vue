<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    data: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div>
        <div
            v-if="data.links.length > 3"
            class="py-2 flex items-center justify-between"
        >
            <div class="hidden sm:block">
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    {{ $t("pagination.showing") }}
                    <span class="font-medium">{{ data.from }}</span>
                    {{ $t("pagination.to") }}
                    <span class="font-medium">{{ data.to }}</span>
                    {{ $t("pagination.of") }}
                    <span class="font-medium">{{ data.total }}</span>
                    {{ $t("pagination.results") }}
                </p>
            </div>
            <div class="flex-1 flex justify-between sm:justify-end">
                <Link
                    v-if="data.prev_page_url"
                    :href="data.prev_page_url"
                    class="relative inline-flex items-center px-3 py-1.5 border border-gray-300 dark:border-gray-700 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 hover:dark:bg-gray-900"
                    preserve-scroll
                    preserve-state
                >
                    {{ $t("pagination.previous") }}
                </Link>

                <div
                    v-else
                    class="relative cursor-not-allowed inline-flex items-center px-3 py-1.5 border border-gray-300 dark:border-gray-700 text-sm font-medium rounded-md text-gray-700 dark:text-gray-500 bg-white dark:bg-gray-800/40 hover:bg-gray-50"
                >
                    {{ $t("pagination.previous") }}
                </div>

                <Link
                    v-if="data.next_page_url"
                    :href="data.next_page_url"
                    class="ml-2 relative inline-flex items-center px-3 py-1.5 border border-gray-300 dark:border-gray-700 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 hover:dark:bg-gray-900"
                    preserve-scroll
                    preserve-state
                >
                    {{ $t("pagination.next") }}
                </Link>
                <div
                    v-else
                    class="ml-2 relative cursor-not-allowed inline-flex items-center px-3 py-1.5 border border-gray-300 dark:border-gray-700 text-sm font-medium rounded-md text-gray-700 dark:text-gray-500 bg-white dark:bg-gray-800/40 hover:bg-gray-50"
                >
                    {{ $t("pagination.next") }}
                </div>
            </div>
        </div>
    </div>
</template>
