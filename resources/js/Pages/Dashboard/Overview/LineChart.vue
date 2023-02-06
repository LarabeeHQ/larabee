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

            <div ref="chart" />
        </div>
    </div>
</template>
<script>
import Highcharts from "highcharts";

export default {
    props: {
        dateRange: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            chart: null,
            cycle: "day",
            data: null,
        };
    },

    async mounted() {
        await this.loadChartData();
    },

    methods: {
        setCycle(cycle) {
            this.cycle = cycle;
            this.loadChartData();
        },

        renderChart() {
            Highcharts.chart(this.$refs.chart, {
                chart: {
                    backgroundColor: "transparent",
                },

                time: {
                    timezone: this.$page.props.auth.user.timezone.value,
                },
                accessibility: {
                    enabled: false,
                },
                credits: { enabled: false },

                yAxis: {
                    title: false,
                    labels: {
                        formatter: function () {
                            return this.value * 1000;
                        },
                    },
                },

                xAxis: {
                    title: false,
                    type: "datetime",
                    showFirstLabel: true,
                    showLastLabel: true,
                    min: this.data.min,
                    max: this.data.max,

                    labels: {
                        formatter: function () {
                            return Highcharts.dateFormat(
                                "%I:%M %p",
                                this.value
                            );
                        },
                    },
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
                    label: {
                        formatter: function () {
                            return this.value * 1000;
                        },
                    },
                    series: {
                        label: {
                            connectorAllowed: false,
                        },
                        pointStart: this.data.pointStart,
                        pointInterval: this.data.pointInterval,

                        color: this.data.color,
                        fillOpacity: this.data.fillOpacity,

                        marker: {
                            enabled: false,
                        },
                    },
                },

                series: this.data.data,

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
        },

        loadChartData() {
            axios
                .get(
                    route("dashboard.load-chart", {
                        start: this.dateRange.start,
                        end: this.dateRange.end,
                    })
                )
                .then((response) => {
                    this.data = response.data;

                    this.$refs.chart.value = null;
                    this.renderChart();
                });
        },
    },
};
</script>

<style></style>
