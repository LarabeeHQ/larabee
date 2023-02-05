<script setup>
import { ref } from "vue";
import LineChart from "./LineChart.vue";
import BarChart from "./BarChart.vue";
import { ChevronUpIcon } from "@heroicons/vue/24/outline";

const stats = [
    {
        id: "uniqueVisitors",
        name: "Unique Visitors",
        current: "130K",
        past: 100,
    },
    {
        id: "pageViews",
        name: "Page Views",
        current: "135.4K",
        past: 90,
    },
    {
        id: "newSessions",
        name: "New Sessions",
        current: "80K",
        past: -80,
    },
    {
        id: "bounceRate",
        name: "Bounce Rate",
        current: 75.4,
        past: -60,
    },
    {
        id: "sessionDuration",
        name: "Session Duration",
        current: "2m 30s",
        past: 70,
    },
];

const selected = ref("uniqueVisitors");

const setChart = (stat) => {
    selected.value = stat;
};

const { dateRange } = defineProps({
    dateRange: Object,
});
</script>
<template>
    <div class="overflow-hidden rounded-xl bg-white dark:bg-gray-900 p-6">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-5">
            <div
                v-for="stat in stats"
                :key="stat"
                @click="setChart(stat.id)"
                :class="{
                    'overflow-hidden rounded-md bg-white dark:bg-gray-800 px-4 py-5 sm:p-6 cursor-pointer': true,
                    'shadow-card shadow-green-500/50': stat.id === selected,
                }"
            >
                <div
                    class="truncate text-xs tracking-wider font-bold uppercase text-gray-200"
                >
                    {{ stat.name }}
                </div>
                <div class="flex items-center space-x-2">
                    <div
                        class="mt-1 text-3xl font-bold tracking-tight text-gray-900 dark:text-white"
                    >
                        130K
                    </div>

                    <div class="flex items-center space-x-1">
                        <ChevronUpIcon
                            class="h-4 w-4 text-green-400 stroke-2"
                        />
                        <div class="text-green-400 font-medium text-sm">
                            100%
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <LineChart :date-range="dateRange" />
    </div>
</template>
