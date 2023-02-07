<script setup>
import { ref } from "vue";
import {
    RadioGroup,
    RadioGroupDescription,
    RadioGroupLabel,
    RadioGroupOption,
} from "@headlessui/vue";

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const selectedPlan = ref(plans[0]);
const yearly = ref(false);

import { plansProd } from "~/private/plans.js";
import { plansLocal } from "~/private/plans.local.js";

const plans = ref(
    import.meta.env.VITE_APP_ENV === "local" ? plansLocal : plansProd
);

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
            <div>
                <h2
                    class="text-center text-xl font-bold text-white sm:text-3xl sm:leading-none sm:tracking-tight lg:text-6xl"
                >
                    Simple And Transparent Pricing
                </h2>
                <p
                    class="mt-6 max-w-xl mx-auto text-xl text-gray-500 text-center"
                >
                    Choose an affordable plan that's packed with the best
                    features for engaging your audience, creating customer
                    loyalty, and driving sales.
                </p>
                <div class="sm:flex sm:flex-col sm:align-center">
                    <div
                        class="relative self-center rounded-full border-2 border-white p-1 flex mt-8"
                    >
                        <div
                            @click="yearly = false"
                            :class="{
                                'relative w-1/2 rounded-full py-2 text-sm font-bold  whitespace-nowrap focus:outline-none focus:z-10 sm:w-auto sm:px-8 cursor-pointer': true,
                                'bg-white text-gray-800': !yearly,
                                'text-white': yearly,
                            }"
                        >
                            Monthly
                        </div>
                        <div
                            @click="yearly = true"
                            :class="{
                                'ml-0.5 relative w-1/2 lg:flex items-center rounded-full py-2 text-sm font-bold  whitespace-nowrap focus:outline-none focus:z-10 sm:w-auto sm:px-8 cursor-pointer': true,
                                'bg-white text-gray-800': yearly,
                                'text-white': !yearly,
                            }"
                        >
                            Yearly
                            <div
                                class="hidden lg:absolute lg:inline-flex items-center px-4 py-1.5 rounded-full text-xs font-medium bg-blue-600 text-white lg:ml-24 cursor-default"
                            >
                                🎉 Save 2 months
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center mt-6"></div>
            </div>
            <div class="mt-6 max-w-3xl mx-auto">
                <RadioGroup v-model="selectedPlan">
                    <RadioGroupLabel class="sr-only">
                        Pricing plans
                    </RadioGroupLabel>
                    <div class="relative -space-y-px rounded-md bg-white">
                        <RadioGroupOption
                            as="template"
                            v-for="(plan, planIdx) in plans"
                            :key="plan.name"
                            :value="plan"
                            v-slot="{ checked, active }"
                        >
                            <div
                                :class="[
                                    planIdx === 0
                                        ? 'rounded-tl-md rounded-tr-md'
                                        : '',
                                    planIdx === plans.length - 1
                                        ? 'rounded-bl-md rounded-br-md'
                                        : '',
                                    checked
                                        ? 'bg-indigo-50 border-indigo-200 z-10'
                                        : 'border-gray-200',
                                    'relative border p-4 flex flex-col cursor-pointer md:pl-4 md:pr-6 md:grid md:grid-cols-2 focus:outline-none',
                                ]"
                            >
                                <span class="flex items-center text-sm">
                                    <span
                                        :class="[
                                            checked
                                                ? 'bg-indigo-600 border-transparent'
                                                : 'bg-white border-gray-300',
                                            active
                                                ? 'ring-2 ring-offset-2 ring-indigo-500'
                                                : '',
                                            'h-4 w-4 rounded-full border flex items-center justify-center',
                                        ]"
                                        aria-hidden="true"
                                    >
                                        <span
                                            class="rounded-full bg-white w-1.5 h-1.5"
                                        />
                                    </span>
                                    <RadioGroupLabel
                                        as="span"
                                        :class="[
                                            checked
                                                ? 'text-indigo-900'
                                                : 'text-gray-900',
                                            'ml-3 font-medium',
                                        ]"
                                    >
                                        {{ plan.name }} / page views per month
                                    </RadioGroupLabel>
                                </span>
                                <RadioGroupDescription
                                    as="span"
                                    class="text-sm md:ml-0 md:pl-0 md:text-right"
                                >
                                    {{
                                        yearly
                                            ? `$${plan.priceYearly}`
                                            : `$${plan.priceMonthly}`
                                    }}
                                    {{ yearly ? "/year" : "/month" }}
                                </RadioGroupDescription>
                            </div>
                        </RadioGroupOption>
                    </div>
                </RadioGroup>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
