<script setup>
import helper from "@/helper";
import Chart from "chart.js/auto";
import { ref, onMounted, watch, reactive } from "vue";

const chartElementRef = ref(null);
let chartElement;

const online = ref(0);
const data = reactive({
    total: 0,
    totalPrevious: 0,
    chart: {
        label: "",
        data: [],
        labels: [],
    },
});

const { dateRange, website } = defineProps({
    dateRange: Object,
    website: Object,
});

const loadOnline = () => {
    axios
        .get(route("analytics.statistics"), {
            params: {
                ...dateRange,
                metric: "online",
            },
        })
        .then((response) => {
            online.value = response.data;
        });
};

const loadChartData = () => {
    axios
        .get(route("analytics.statistics"), {
            params: {
                ...dateRange,
                metric: "unique-users",
            },
        })
        .then((response) => {
            data.total = response.data.total;
            data.totalPrevious = response.data.totalPrevious;
            data.chart = response.data.chart;

            renderChart();
        });
};

const renderChart = () => {
    // clear canva
    if (chartElement) {
        chartElement.data.labels = data.chart.labels;
        chartElement.data.datasets[0].data = data.chart.data;
        chartElement.data.datasets[0].label = data.chart.label;
        chartElement.update();
        return;
    }

    chartElement = new Chart(chartElementRef.value, {
        type: "bar",
        data: {
            labels: data.chart.labels,
            datasets: [
                {
                    label: data.chart.label,
                    data: data.chart.data,
                    fill: true,
                    backgroundColor: helper.transparentize("#7100fd", 0.2),
                    borderColor: "#7100fd",
                    borderRadius: 4,
                    borderSkipped: false,
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false,
                },

                tooltip: {
                    displayColors: false,
                },
            },
            scales: {
                x: {
                    grid: {
                        display: false,
                    },
                },
                y: {
                    display: false,
                },
            },
        },
    });
};

onMounted(() => {
    loadOnline();
});

watch(
    dateRange,
    () => {
        loadChartData();
    },
    { immediate: true }
);
</script>

<template>
    <div class="col-span-12 lg:col-span-6 card p-4">
        <div class="flex items-center justify-between mb-8">
            <div>
                <div
                    class="capitalize text-base font-semibold text-black dark:text-white"
                >
                    Unique Users
                </div>
                <div class="flex items-center space-x-1.5">
                    <div class="h-2 w-2 bg-green-500 rounded-full"></div>
                    <div
                        class="flex items-center space-x-1 text-zinc-800 dark:text-white text-sm font-medium"
                    >
                        <div>{{ online }}</div>
                        <div>online</div>
                    </div>
                </div>
            </div>

            <div class="flex items-end">
                <div class="flex flex-row items-center">
                    <div
                        class="text-3xl font-extrabold leading-none text-zinc-800 dark:text-zinc-100"
                    >
                        {{ helper.kFormatter(data.total) }}
                    </div>
                    <div
                        :class="{
                            'font-bold ml-2 text-sm': true,
                            'text-zinc-400': data.totalPrevious == 0,
                            'text-green-400': data.totalPrevious > 0,
                            'text-red-400': data.totalPrevious < 0,
                        }"
                    >
                        <span v-if="data.totalPrevious > 0" class="font-bold">
                            +
                        </span>
                        {{ data.totalPrevious }}%
                    </div>
                </div>
            </div>
        </div>

        <canvas ref="chartElementRef"></canvas>
    </div>
</template>
