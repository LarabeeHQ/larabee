<script setup>
import SectionBorder from "@/Components/SectionBorder.vue";
import AuthenticatedLayout from "@/Layouts/App/Master.vue";
import DeleteUserForm from "./Partials/DeleteUserForm.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
    mustVerifyEmail: Boolean,
    status: String,
    timezones: Object,
});
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-2xl font-semibold text-gray-900">
                        Your Account
                    </h1>
                </div>
            </div>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 px-4 sm:px-0">
                <div>
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        :timezones="timezones"
                    />

                    <SectionBorder />
                </div>

                <div>
                    <UpdatePasswordForm class="mt-10 sm:mt-0" />
                    <SectionBorder />
                </div>

                <div>
                    <DeleteUserForm class="mt-10 sm:mt-0" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
