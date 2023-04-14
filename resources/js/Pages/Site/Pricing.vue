<script setup>
import { CheckIcon } from "@heroicons/vue/20/solid";
import { Head, usePage, Link } from "@inertiajs/vue3";

import WebsiteLayout from "@/Layouts/Site/Master.vue";
import Testimonial from "./Partials/Testimonial.vue";
import Cta from "./Partials/Cta.vue";

const plans = usePage().props.plans;
</script>
<template>
    <Head title="Pricing" />
    <WebsiteLayout>
        <div class="bg-white py-24 sm:py-32">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div>
                    <div class="mx-auto max-w-4xl text-center">
                        <div
                            class="mt-2 text-xl font-bold tracking-tight text-gray-900 dark:text-gray-100 sm:text-3xl"
                        >
                            Simple And Transparent Pricing
                        </div>
                    </div>
                    <p
                        class="mx-auto mt-6 max-w-2xl text-center text-base leading-6 text-gray-600 dark:text-gray-300"
                    >
                        Our plans and prices are simple and transparent, with no
                        additional costs
                    </p>

                    <div
                        class="isolate mx-auto mt-10 grid max-w-md grid-cols-1 gap-8 lg:mx-0 lg:max-w-none lg:grid-cols-3"
                    >
                        <div
                            v-for="tier in plans"
                            :key="tier"
                            :class="[
                                tier.mostPopular
                                    ? 'ring-2 ring-blue-600 dark:ring-blue-500'
                                    : 'ring-1 ring-gray-300 dark:ring-gray-700',
                                'rounded-2xl p-8 xl:p-10',
                            ]"
                        >
                            <div
                                class="flex items-center justify-between gap-x-4"
                            >
                                <h3
                                    :id="tier"
                                    :class="[
                                        tier.mostPopular
                                            ? 'text-blue-600'
                                            : 'text-gray-900 dark:text-white',
                                        'text-lg font-semibold leading-8',
                                    ]"
                                >
                                    {{ tier.name }}
                                </h3>
                                <p
                                    v-if="tier.mostPopular"
                                    class="rounded-full bg-blue-600/10 dark:bg-blue-500/50 py-1 px-2.5 text-xs font-semibold leading-5 text-blue-600 dark:text-white"
                                >
                                    Most popular
                                </p>
                            </div>
                            <p
                                class="mt-4 text-sm leading-6 text-gray-600 dark:text-gray-300"
                            >
                                {{ tier.description }}
                            </p>
                            <div class="mt-6 gap-x-1 flex items-end">
                                <div class="flex items-start">
                                    <div
                                        class="text-lg font-semibold text-gray-600 dark:text-gray-100"
                                    >
                                        $&nbsp;
                                    </div>
                                    <div
                                        class="text-5xl font-bold tracking-tight text-gray-900 dark:text-gray-100"
                                    >
                                        {{ tier.price }}
                                    </div>
                                </div>
                                <div class="flex align-baseline">
                                    <div
                                        class="text-sm font-semibold leading-6 text-gray-600 dark:text-gray-100"
                                    >
                                        /month
                                    </div>
                                </div>
                            </div>
                            <Link
                                :href="route('register')"
                                class="bg-blue-600 text-white shadow-sm hover:bg-blue-500 cursor-pointer mt-6 block rounded-md py-2 px-3 text-center text-sm font-semibold leading-6 outline-none"
                            >
                                {{
                                    tier.trialDays >= 1
                                        ? `Start ${tier.trialDays}-day free trial`
                                        : "Subscribe"
                                }}
                            </Link>
                            <ul
                                role="list"
                                class="mt-8 space-y-3 text-sm leading-6 text-gray-600 dark:text-gray-400 xl:mt-10 font-medium"
                            >
                                <li
                                    v-for="feature in tier.features"
                                    :key="feature"
                                    class="flex gap-x-3"
                                >
                                    <CheckIcon
                                        class="h-6 w-5 flex-none text-blue-600 stroke-2"
                                        aria-hidden="true"
                                    />
                                    {{ feature }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <Testimonial />
        <Cta />
    </WebsiteLayout>
</template>
