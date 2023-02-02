<template>
    <div>
        <h3 class="text-lg font-medium leading-6 text-gray-900">
            Last 30 days
        </h3>
        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-4">
            <div
                class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6"
            >
                <dt class="truncate text-sm font-medium text-gray-500">
                    Sessions
                </dt>
                <dd
                    class="mt-1 text-3xl font-semibold tracking-tight text-gray-900"
                >
                    {{ stats.sessions }}
                </dd>
            </div>

            <div
                class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6"
            >
                <dt class="truncate text-sm font-medium text-gray-500">
                    Page Views
                </dt>
                <dd
                    class="mt-1 text-3xl font-semibold tracking-tight text-gray-900"
                >
                    {{ stats.page_views }}
                </dd>
            </div>

            <div
                class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6"
            >
                <dt class="truncate text-sm font-medium text-gray-500">
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
                <dt class="truncate text-sm font-medium text-gray-500">
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
</template>
<script>
export default {
    name: "Stats",
    props: {
        stats: {
            type: Object,
            required: true,
        },
    },
};
</script>
