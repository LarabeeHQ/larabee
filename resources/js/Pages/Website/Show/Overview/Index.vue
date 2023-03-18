<script setup>
import Chart from "chart.js/auto";
import helper from "@/helper";
import { ref, watch, onMounted } from "vue";
import { ChevronUpIcon, ChevronDownIcon } from "@heroicons/vue/24/outline";
import { current } from "tailwindcss/colors";

const tabs = ref([
    {
        id: "sessions",
        name: "Sessions",
        value: null,
        change: null,
        helperFunction: helper.kFormatter,
    },
    {
        id: "page-views",
        name: "Page Views",
        value: null,
        change: null,
        helperFunction: helper.kFormatter,
    },
    {
        id: "bounce",
        name: "Bounce Rate",
        value: null,
        change: null,
        helperFunction: (value) => {
            return `${value}%`;
        },
    },
    {
        id: "session-avg",
        name: "Session Duration",
        value: null,
        change: null,
        helperFunction: helper.secondsToTime,
    },
]);
const currentTab = ref(tabs.value[0]);

const chartType = ref("line");
const setCurrentTab = (stat) => {
    currentTab.value = stat;
};

const { dateRange, website, selectedFilter } = defineProps({
    dateRange: Object,
    website: Object,
    selectedFilter: Object,
});

const chartElementRef = ref(null);
let chartElement;
const chartData = ref(null);

const loadData = () => {
    axios
        .get(route("websites.statistics", website.id), {
            params: {
                start: dateRange.date.start,
                end: dateRange.date.end,
                metric: "overview",
                group: dateRange.group,
                key: dateRange.key,
            },
        })
        .then((response) => {
            tabs.value = tabs.value.map((tab) => {
                return {
                    ...tab,
                    value: response.data[tab.id].value,
                    change: response.data[tab.id].change,
                };
            });
        });
};

const cycle = ref("day");

const setCycle = (cycle) => {
    cycle.value = cycle;
    loadChartData();
};

const renderChart = () => {
    const backgroundColorPositive = "rgba(204, 240, 227, 0.3)";
    const borderColorPositive = "#32C48D";
    const backgroundColorNegative = "rgba(247, 0, 160, 0.1)";
    const borderColorNegative = "#f700a0";

    let chartDataData;
    let chartDataLabel;
    let chartDataLabels;

    switch (currentTab.value.id) {
        case "sessions":
            chartDataData = chartData.value.sessions.data;
            chartDataLabel = chartData.value.sessions.label;
            chartDataLabels = chartData.value.sessions.labels;
            break;

        case "page-views":
            chartDataData = chartData.value.pageViews.data;
            chartDataLabel = chartData.value.pageViews.label;
            chartDataLabels = chartData.value.pageViews.labels;
            break;

        case "bounce":
            chartDataData = chartData.value.bounceRate.data;
            chartDataLabel = chartData.value.bounceRate.label;
            chartDataLabels = chartData.value.bounceRate.labels;
            break;

        case "session-avg":
            chartDataData = chartData.value.sessionDuration.data;
            chartDataLabel = chartData.value.sessionDuration.label;
            chartDataLabels = chartData.value.sessionDuration.labels;
            break;
    }

    // clear canva
    if (chartElement) {
        chartElement.data.labels = chartDataLabels;
        chartElement.data.datasets[0].data = chartDataData;
        chartElement.data.datasets[0].label = chartDataLabel;
        chartElement.update();
        return;
    }

    chartElement = new Chart(chartElementRef.value, {
        type: "line",
        data: {
            labels: chartDataLabels,
            datasets: [
                {
                    label: chartDataLabel,
                    data: chartDataData,
                    fill: true,
                    backgroundColor: backgroundColorPositive,
                    borderColor: borderColorPositive,
                    tension: 0.06,
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false,
                },
            },
            scales: {
                x: {
                    grid: {
                        display: false,
                    },
                },
                y: {
                    stacked: true,
                },
            },
        },
    });
};

const loadChartData = () => {
    console.log(dateRange);
    axios
        .get(route("websites.statistics", website.id), {
            params: {
                start: dateRange.date.start,
                end: dateRange.date.end,
                metric: "chart",
                group: dateRange.group,
                key: dateRange.key,
            },
        })
        .then((response) => {
            chartData.value = response.data;
            renderChart();
        });
};

watch(
    dateRange,
    () => {
        loadData();
        loadChartData();
    },
    { immediate: true }
);

watch(currentTab, () => {
    renderChart();
});
</script>
<template>
    <div class="card p-6">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-4">
            <div
                v-for="data in tabs"
                :key="data"
                @click="setCurrentTab(data)"
                :class="{
                    'border-t-4 overflow-hidden rounded-md bg-zinc-100 dark:bg-zinc-900 px-4 py-5 sm:p-6 cursor-pointer': true,
                    ' border-green-400': data.id == currentTab.id,
                    ' border-transparent': data.id != currentTab.id,
                }"
            >
                <div
                    class="truncate text-xs tracking-wider font-bold uppercase text-zinc-800 dark:text-zinc-200"
                >
                    {{ data.name }}
                </div>
                <div class="flex items-center space-x-2">
                    <div
                        class="mt-1 text-3xl font-bold tracking-tight text-zinc-900 dark:text-white"
                    >
                        {{ data.helperFunction(data.value) }}
                    </div>

                    <div class="flex items-center space-x-1">
                        <ChevronUpIcon
                            v-if="data.change > 0"
                            class="h-4 w-4 text-green-400 stroke-2"
                        />
                        <ChevronDownIcon
                            v-if="data.change < 0"
                            class="h-4 w-4 text-red-400 stroke-2"
                        />
                        <div
                            v-if="data.change > 0"
                            :class="{
                                'font-medium text-sm': true,
                                'text-green-400': data.change > 0,
                                'text-red-400': data.change < 0,
                            }"
                        >
                            {{ data.helperFunction(data.change) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-4">
            <div class="px-4 py-4">
                <div
                    class="flex flex-col sm:flex-row justify-between items-baseline mb-4"
                >
                    <!-- <h2 class="font-medium text-sm text-gray-600"></h2>
                <div
                    class="bg-gray-100 flex items-baseline px-1.5 py-1 text-sm rounded-lg font-medium"
                >
                    <div
                        @click="setCycle('day')"
                        :class="{
                            'rounded-md px-3 py-1.5 cursor-pointer transition': true,
                            'bg-white shadow text-blue-600': cycle == 'day',
                        }"
                    >
                        Hour
                    </div>
                    <div
                        @click="setCycle('week')"
                        :class="{
                            'rounded-md px-3 py-1.5 cursor-pointer transition': true,
                            'bg-white shadow text-blue-600': cycle == 'week',
                        }"
                    >
                        Day
                    </div>
                    <div
                        @click="setCycle('month')"
                        :class="{
                            'rounded-md px-3 py-1.5 cursor-pointer transition': true,
                            'bg-white shadow text-blue-600': cycle == 'month',
                        }"
                    >
                        Week
                    </div>
                </div> -->
                </div>

                <canvas ref="chartElementRef"></canvas>
            </div>
        </div>
    </div>
</template>
