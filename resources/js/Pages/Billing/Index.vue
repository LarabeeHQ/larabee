<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

import PrimaryButton from "@/Components/PrimaryButton.vue";
</script>
<template>
    <AuthenticatedLayout>
        <div>
            <div>
                <div
                    class="px-4 py-4 sm:px-6 sm:py-6 bg-gray-800 rounded-xl border border-gray-700 text-gray-100"
                >
                    <div class="flex flex-col space-y-4">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium text-gray-100">
                                <div class="flex items-center">
                                    Billing Portal
                                </div>
                            </h3>
                            <p class="mt-1 text-sm text-gray-300">
                                Click on the link below to manage your
                                subscription, update your credit card and see
                                your invoices
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
            </div>
        </div>
    </AuthenticatedLayout>
</template>
