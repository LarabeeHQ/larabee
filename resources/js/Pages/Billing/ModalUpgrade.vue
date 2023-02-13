<script setup>
import { ref } from "vue";
import DialogModal from "@/Components/DialogModal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

import {
    RadioGroup,
    RadioGroupDescription,
    RadioGroupLabel,
    RadioGroupOption,
} from "@headlessui/vue";

const isLoading = ref(false);

import { plans as plansProd } from "../../../../private/plans/prod.js";
import { plans as plansDev } from "../../../../private/plans/dev.js";

const plans = ref(
    import.meta.env.VITE_APP_ENV === "local" ? plansDev : plansProd
);

const selectedPlan = ref(plans.value[0]);
const yearly = ref(false);

const generateCheckout = () => {
    isLoading.value = true;
    axios
        .post(route("billing.generate-checkout-link"), {
            stripePlan: yearly.value
                ? selectedPlan.value.stripeIdYearly
                : selectedPlan.value.stripeIdMonthly,
        })
        .then((data) => {
            window.Stripe(import.meta.env.VITE_STRIPE_KEY).redirectToCheckout({
                sessionId: data.data,
            });
        })
        .catch((error) => {
            isLoading.value = false;
            if (error.response.status === 422) {
                this.uploadHasErrors = error.response.data.message;
            }
        });
};

const show = ref(false);

const open = () => {
    show.value = true;
};

defineExpose({
    open,
});
</script>
<template>
    <DialogModal max-width="xl" :show="show" @close="show = false">
        <template #title>Upgrade your free trial</template>

        <template #description
            >Move your changelogs from another service to Changelogfy easily
            with our auto import service
        </template>

        <template #content>
            <div class="mb-4">
                <div class="sm:flex sm:flex-col sm:align-center">
                    <div
                        class="relative self-center rounded-md border border-gray-100 p-1 flex"
                    >
                        <div
                            @click="yearly = false"
                            :class="{
                                'relative w-1/2 rounded py-1.5 text-sm font-bold  whitespace-nowrap focus:outline-none focus:z-10 sm:w-auto sm:px-6 cursor-pointer': true,
                                'bg-gray-100 text-gray-800': !yearly,
                                'text-black': yearly,
                            }"
                        >
                            Monthly
                        </div>
                        <div
                            @click="yearly = true"
                            :class="{
                                'relative w-1/2 rounded py-1.5 text-sm font-bold  whitespace-nowrap focus:outline-none focus:z-10 sm:w-auto sm:px-6 cursor-pointer': true,
                                'bg-gray-100 text-gray-800': yearly,
                                'text-black': !yearly,
                            }"
                        >
                            Yearly
                        </div>
                    </div>
                </div>
            </div>
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
        </template>

        <template #footer>
            <PrimaryButton
                @click="generateCheckout"
                :disabled="isLoading"
                :class="{ 'opacity-25': isLoading }"
            >
                Subscribe
            </PrimaryButton>
        </template>
    </DialogModal>
</template>
