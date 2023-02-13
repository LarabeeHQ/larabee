<script setup>
import { ref, onMounted } from "vue";
import Highcharts from "highcharts";
import { usePage } from "@inertiajs/vue3";
const user = usePage().props.auth.user;

const chartElement = ref(null);
const cycle = ref("day");
const data = ref(null);

const { dateRange, website } = defineProps({
    dateRange: Object,
    website: Object,
});

const setCycle = (cycle) => {
    cycle.value = cycle;
    loadChartData();
};

const renderChart = () => {
    Highcharts.chart(chartElement.value, {
        chart: {
            backgroundColor: "transparent",
        },

        accessibility: {
            enabled: false,
        },
        credits: { enabled: false },

        yAxis: {
            title: false,
        },

        xAxis: {
            title: false,
            type: "datetime",
            showFirstLabel: true,
            showLastLabel: true,
        },

        tooltip: {
            valueDecimals: 3,
            pointFormat: "{point.y}ms",
            backgroundColor: "#fff",
            borderColor: "#ddd",
            borderRadius: 6,
            useHTML: true,
            padding: 10,
            animation: true,
            shadow: false,
            xDateFormat: "%Y-%m-%d %H:%M",
        },

        title: false,

        legend: false,

        plotOptions: {
            line: {
                lineWidth: 0.5,
                linecap: "round",
                marker: false,
            },

            series: {
                label: {
                    connectorAllowed: false,
                },
                pointStart: data.value.pointStart,
                pointInterval: data.value.pointInterval,

                color: data.value.color,
                fillOpacity: data.value.fillOpacity,

                marker: {
                    enabled: false,
                },
            },
        },

        series: data.value.data,

        responsive: {
            rules: [
                {
                    condition: {
                        maxWidth: 500,
                    },
                    chartOptions: {
                        legend: {
                            layout: "horizontal",
                            align: "center",
                            verticalAlign: "bottom",
                        },
                    },
                },
            ],
        },
    });
};

const loadChartData = () => {
    axios
        .get(route("websites.statistics", website.id), {
            params: {
                start: dateRange.start,
                end: dateRange.end,
                metric: "chart",
            },
        })
        .then((response) => {
            data.value = response.data;

            renderChart();
        });
};

onMounted(() => {
    loadChartData();
});
</script>

<template>
    <div class="space-y-4">
        <div class="px-4 py-4">
            <div
                class="flex flex-col sm:flex-row justify-between items-baseline mb-4"
            >
                <h2 class="font-medium text-sm text-gray-600"></h2>
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
                </div>
            </div>

            <div ref="chartElement" />
        </div>
    </div>
</template>
