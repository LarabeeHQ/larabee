<script setup>
import { usePage, Head } from "@inertiajs/vue3";
import { onMounted, ref, reactive } from "vue";
import Chart from "chart.js/auto";
import helper from "@/helper";

import ModalUpgrade from "@/Pages/App/Billing/ModalUpgrade.vue";
import AuthenticatedLayout from "@/Layouts/App/Master.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {
    InformationCircleIcon,
    ArrowSmallRightIcon,
} from "@heroicons/vue/20/solid";

const user = usePage().props.auth.user;

const { data } = defineProps({
    data: Object,
});

const chartElementRef = ref(null);
let chartElement;

const renderChart = () => {
    chartElement = new Chart(chartElementRef.value, {
        type: "bar",
        data: {
            labels: data.labels,
            datasets: [
                {
                    label: data.label,
                    data: data.data,
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
    renderChart();
});
</script>
<template>
    <Head title="Billing" />
    <AuthenticatedLayout>
        <div class="space-y-4">
            <div v-if="user.plan.name == 'trial'" class="card p-4">
                <div class="flex items-center w-full space-x-2">
                    <div class="flex-shrink-0">
                        <InformationCircleIcon
                            class="h-5 w-5 text-gray-400"
                            aria-hidden="true"
                        />
                    </div>
                    <div
                        class="flex w-full justify-between items-center space-x-2"
                    >
                        <div
                            class="text-sm font-medium text-zinc-800 dark:text-white"
                        >
                            You are currently on a trial period until
                            {{ helper.formatDate(user.trial_ends_at) }}.
                        </div>
                        <div>
                            <a
                                :href="route('billing.checkout')"
                                class="flex items-center space-x-1 rounded-md bg-green-500 px-4 py-1.5 text-sm font-semibold text-white hover:bg-green-600 focus:outline-none"
                            >
                                <div>Upgrade Now</div>
                                <ArrowSmallRightIcon
                                    class="h-5 w-5"
                                    aria-hidden="true"
                                />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else class="card p-4">
                <div class="flex flex-col space-y-4">
                    <div class="px-4 sm:px-0">
                        <h3
                            class="text-lg font-medium text-zinc-800 dark:text-gray-100"
                        >
                            <div class="flex items-center">Billing Portal</div>
                        </h3>
                        <p
                            class="mt-1 text-sm text-zinc-700 dark:text-gray-300 font-medium"
                        >
                            Click on the link below to manage your subscription,
                            update your credit card and see your invoices
                        </p>
                    </div>
                    <div class="px-4 sm:px-0">
                        <PrimaryButton
                            :href="route('billing.redirect-to-portal')"
                        >
                            Go To Portal
                        </PrimaryButton>
                    </div>
                </div>
            </div>

            <div class="card p-4">
                <div class="w-100 h-100">
                    <div
                        class="flex flex-row justify-between items-center mb-4"
                    >
                        <h5 class="capitalize font-medium">
                            {{ user.plan.name }}
                        </h5>
                    </div>
                    <div class="grid grid-cols-2 gap-y-8 gap-x-4">
                        <div class="col-12 col-md-6">
                            <div>
                                <div class="text-muted">Total Events:</div>
                                <div class="">
                                    {{ helper.kFormatter(data.totalEvents) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div>
                                <div class="text-muted">Data retention:</div>
                                <div class="">5 Years</div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div>
                                <div class="text-muted">Total Sites:</div>
                                <div class="">{{ data.totalSites }}</div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <p>
                                <span class="text-muted">API quota:</span
                                ><br /><span class="">50 requests per day</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card p-6">
                <div class="flex items-center justify-between mb-8">
                    <div
                        class="text-sm font-medium leading-none text-zinc-800 dark:text-zinc-100"
                    >
                        Event usage: {{ data.startCycle }} —
                        {{ data.endCycle }} (UTC)
                    </div>
                </div>

                <canvas ref="chartElementRef"></canvas>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
