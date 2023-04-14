<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    data: {
        type: Object,
        required: true,
    },

    style: {
        type: String,
        required: false,
        default: "list",
    },
});
</script>

<template>
    <nav v-if="style == 'table'" aria-label="Pagination">
        <div
            v-if="data.links.length > 3"
            class="bg-gray-50 px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6"
        >
            <div class="hidden sm:block">
                <p class="text-sm text-gray-700">
                    Showing
                    <span class="font-medium">{{ data.from }}</span>
                    to
                    <span class="font-medium">{{ data.to }}</span>
                    of
                    <span class="font-medium">{{ data.total }}</span>
                    results
                </p>
            </div>
            <div class="flex-1 flex justify-between sm:justify-end">
                <Link
                    v-if="data.prev_page_url"
                    :href="data.prev_page_url"
                    class="relative inline-flex items-center px-3 py-1.5 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                >
                    Previous
                </Link>
                <div
                    v-else
                    class="relative inline-flex items-center px-3 py-1.5 border border-gray-300 text-sm font-medium rounded-md text-gray-400 bg-gray-100"
                >
                    Previous
                </div>

                <Link
                    v-if="data.next_page_url"
                    :href="data.next_page_url"
                    class="ml-2 relative inline-flex items-center px-3 py-1.5 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                >
                    Next
                </Link>
                <div
                    v-else
                    class="ml-2 relative inline-flex items-center px-3 py-1.5 border border-gray-300 text-sm font-medium rounded-md text-gray-400 bg-gray-100"
                >
                    Next
                </div>
            </div>
        </div>
    </nav>

    <nav v-if="style == 'list'" aria-label="Pagination">
        <div
            v-if="data.links.length > 3"
            class="py-2 flex items-center justify-between"
        >
            <div class="hidden sm:block">
                <p class="text-sm text-gray-700">
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
                    class="cursor-pointer relative inline-flex items-center px-3 py-1.5 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                >
                    {{ $t("pagination.previous") }}
                </Link>

                <div
                    v-else
                    class="cursor-pointer relative inline-flex items-center px-3 py-1.5 border border-gray-300 text-sm font-medium rounded-md text-gray-400 bg-gray-100"
                >
                    {{ $t("pagination.previous") }}
                </div>

                <Link
                    v-if="data.next_page_url"
                    :href="data.next_page_url"
                    class="cursor-pointer ml-2 relative inline-flex items-center px-3 py-1.5 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                >
                    {{ $t("pagination.next") }}
                </Link>
                <div
                    v-else
                    class="cursor-pointer ml-2 relative inline-flex items-center px-3 py-1.5 border border-gray-300 text-sm font-medium rounded-md text-gray-400 bg-gray-100"
                >
                    {{ $t("pagination.next") }}
                </div>
            </div>
        </div>
    </nav>
</template>
