<script setup>
import { ref } from "vue";
import {
    RadioGroup,
    RadioGroupDescription,
    RadioGroupLabel,
    RadioGroupOption,
} from "@headlessui/vue";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const yearly = ref(false);

const plans = [
    {
        name: "10K",
        priceMonthly: 9,
        priceYearly: 90,
    },
    {
        name: "100K",
        priceMonthly: 19,
        priceYearly: 190,
    },
    {
        name: "200K",
        priceMonthly: 29,
        priceYearly: 290,
    },
    {
        name: "500K",
        priceMonthly: 49,
        priceYearly: 490,
    },
    {
        name: "1M",
        priceMonthly: 89,
        priceYearly: 890,
    },
    {
        name: "3M",
        priceMonthly: 119,
        priceYearly: 1190,
    },
    {
        name: "5M",
        priceMonthly: 149,
        priceYearly: 1490,
    },
    {
        name: "10M",
        priceMonthly: 199,
        priceYearly: 1990,
    },
    {
        name: "20M",
        priceMonthly: 349,
        priceYearly: 3490,
    },
    {
        name: "50M",
        priceMonthly: 699,
        priceYearly: 6990,
    },
    {
        name: "100M",
        priceMonthly: 999,
        priceYearly: 9990,
    },
];

const selected = ref(plans[0]);

const generateCheckout = (stripeId) => {
    axios
        .post(route("admin.billing.generate-checkout-link"), {
            stripePlan: stripeId,
        })
        .then((data) => {
            window.Stripe(import.meta.env.VITE_STRIPE_KEY).redirectToCheckout({
                sessionId: data.data,
            });
        })
        .catch((error) => {
            // if (error.response.status === 422) {
            //     this.uploadHasErrors = error.response.data.message;
            // }
        });
};
</script>
<template>
    <AuthenticatedLayout>
        <div>
            <div class="sm:flex sm:flex-col sm:align-center">
                <fieldset class="mt-4">
                    <legend class="sr-only">Notification method</legend>
                    <div class="space-y-4">
                        <div
                            v-for="plan in plans"
                            :key="plan"
                            class="flex items-center"
                        >
                            <input
                                :id="plan"
                                name="notification-method"
                                type="radio"
                                :checked="plan === selected"
                                class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
                            />
                            <label
                                :for="plan"
                                class="ml-3 block text-sm font-medium text-gray-700"
                            >
                                {{ plan.name }}/page views,
                                {{
                                    yearly
                                        ? `$${plan.priceYearly}`
                                        : `$${plan.priceMonthly}`
                                }}/month
                            </label>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="mt-6">
                <fieldset class="mt-4">
                    <legend class="sr-only">Plans</legend>
                    <div class="space-y-4">
                        <div
                            v-for="plan in plans"
                            :key="plan"
                            class="flex items-center"
                        >
                            <input
                                :id="plan"
                                name="notification-method"
                                type="radio"
                                :checked="plan === selected"
                                class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
                            />
                            <label
                                :for="plan"
                                class="ml-3 block text-sm font-medium text-gray-700"
                            >
                                {{ plan.name }}/page views,
                                {{
                                    yearly
                                        ? `$${plan.priceYearly}`
                                        : `$${plan.priceMonthly}`
                                }}/month
                            </label>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
