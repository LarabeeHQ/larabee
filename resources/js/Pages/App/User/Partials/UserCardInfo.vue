<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import helper from "@/helper";
import countryHelper from "@/countryHelper";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";

defineProps({
    session: Object,
});

const deleteForm = useForm({});
const beingDeleted = ref(null);

const confirmDeletion = (user) => {
    beingDeleted.value = user;
};

const deleteUser = () => {
    deleteForm.delete(route("users.destroy", beingDeleted.value), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => (beingDeleted.value = null),
    });
};
</script>
<template>
    <div class="col-span-2">
        <div class="card">
            <div class="block divide-y-2 divide-zinc-200 dark:divide-zinc-700">
                <div
                    class="flex items-center px-4 py-2 font-bold text-sm text-black dark:text-white"
                >
                    Attributes
                </div>

                <div
                    v-if="session.first_page_view"
                    class="flex items-center px-4 py-2"
                >
                    <dt class="text-sm font-semibold leading-5 text-gray-500">
                        First visit
                    </dt>
                    <dd
                        class="flex-1 text-sm leading-5 text-left break-all flex justify-end text-gray-900 dark:text-white font-medium"
                    >
                        {{
                            helper.formatDateTime(
                                session.first_page_view.created_at
                            )
                        }}
                    </dd>
                </div>

                <div
                    v-if="session.first_page_view.referrer"
                    class="flex items-center px-4 py-2"
                >
                    <dt class="text-sm font-semibold leading-5 text-gray-500">
                        Referrer
                    </dt>
                    <dd
                        class="flex-1 text-sm leading-5 text-left break-all flex justify-end text-gray-900 dark:text-white"
                    >
                        <div class="flex items-center space-x-1">
                            <img
                                :src="
                                    route(
                                        'websites.favicon',
                                        session.first_page_view.referrer
                                    )
                                "
                                class="w-4 h-4 transition-all opacity-100"
                                :alt="session.first_page_view.referrer"
                            />
                            <a
                                class="truncate hover:underline"
                                target="_blank"
                                :href="`https://${session.first_page_view.referrer}`"
                            >
                                {{ session.first_page_view.referrer }}
                            </a>
                        </div>
                    </dd>
                </div>

                <div class="flex items-center px-4 py-2">
                    <dt class="text-sm font-semibold leading-5 text-gray-500">
                        Country
                    </dt>
                    <dd
                        class="flex-1 text-sm leading-5 text-left break-all flex justify-end text-gray-900 dark:text-white font-medium"
                    >
                        <span class="flex items-center space-x-2">
                            <div v-if="session.country">
                                {{
                                    countryHelper.getCountryFlag(
                                        session.country
                                    )
                                }}
                            </div>

                            <div v-if="session.country">
                                {{
                                    countryHelper.getCountryName(
                                        session.country
                                    )
                                }}
                            </div>
                        </span>
                    </dd>
                </div>

                <div v-if="session.region" class="flex items-center px-4 py-2">
                    <dt class="text-sm font-semibold leading-5 text-gray-500">
                        Region
                    </dt>
                    <dd
                        class="flex-1 text-sm leading-5 text-left break-all flex justify-end text-gray-900 dark:text-white font-medium"
                    >
                        {{ session.region }}
                    </dd>
                </div>

                <div v-if="session.city" class="flex items-center px-4 py-2">
                    <dt class="text-sm font-semibold leading-5 text-gray-500">
                        City
                    </dt>
                    <dd
                        class="flex-1 text-sm leading-5 text-left break-all flex justify-end text-gray-900 dark:text-white font-medium"
                    >
                        {{ session.city }}
                    </dd>
                </div>

                <div
                    v-if="session.language"
                    class="flex items-center px-4 py-2"
                >
                    <dt class="text-sm font-semibold leading-5 text-gray-500">
                        Language
                    </dt>
                    <dd
                        class="flex-1 text-sm leading-5 text-left break-all flex justify-end text-gray-900 dark:text-white font-medium"
                    >
                        {{ session.language }}
                    </dd>
                </div>

                <div v-if="session.os" class="flex items-center px-4 py-2">
                    <dt class="text-sm font-semibold leading-5 text-gray-500">
                        OS
                    </dt>
                    <dd
                        class="flex-1 text-sm leading-5 text-left break-all flex justify-end text-gray-900 dark:text-white font-medium"
                    >
                        {{ session.os }}
                    </dd>
                </div>

                <div v-if="session.browser" class="flex items-center px-4 py-2">
                    <dt class="text-sm font-semibold leading-5 text-gray-500">
                        Browser
                    </dt>
                    <dd
                        class="flex-1 flex items-center justify-end space-x-1 text-sm leading-5 text-left break-all text-gray-900 dark:text-white font-medium"
                    >
                        <span>{{ session.browser }}</span>
                        <span v-if="session.browser_version">
                            ({{ session.browser_version }})
                        </span>
                    </dd>
                </div>

                <div v-if="session.device" class="flex items-center px-4 py-2">
                    <dt class="text-sm font-semibold leading-5 text-gray-500">
                        Device
                    </dt>
                    <dd
                        class="flex-1 flex items-center justify-end space-x-1 text-sm leading-5 text-left break-all text-gray-900 dark:text-white font-medium"
                    >
                        <span v-if="session.device">{{ session.device }}</span>
                        <span v-if="session.screen">
                            ({{ session.screen }})
                        </span>
                    </dd>
                </div>

                <div
                    v-if="session.utm_medium"
                    class="flex items-center px-4 py-2"
                >
                    <dt class="text-sm font-semibold leading-5 text-gray-500">
                        UTM Medium
                    </dt>
                    <dd
                        class="flex-1 text-sm leading-5 text-left break-all flex justify-end text-gray-900 dark:text-white font-medium"
                    >
                        {{ session.utm_medium }}
                    </dd>
                </div>

                <div
                    v-if="session.utm_source"
                    class="flex items-center px-4 py-2"
                >
                    <dt class="text-sm font-semibold leading-5 text-gray-500">
                        UTM Source
                    </dt>
                    <dd
                        class="flex-1 text-sm leading-5 text-left break-all flex justify-end text-gray-900 dark:text-white font-medium"
                    >
                        {{ session.utm_source }}
                    </dd>
                </div>

                <div
                    v-if="session.utm_campaign"
                    class="flex items-center px-4 py-2"
                >
                    <dt class="text-sm font-semibold leading-5 text-gray-500">
                        UTM Campaign
                    </dt>
                    <dd
                        class="flex-1 text-sm leading-5 text-left break-all flex justify-end text-gray-900 dark:text-white font-medium"
                    >
                        {{ session.utm_campaign }}
                    </dd>
                </div>

                <div
                    v-if="session.utm_content"
                    class="flex items-center px-4 py-2"
                >
                    <dt class="text-sm font-semibold leading-5 text-gray-500">
                        UTM Content
                    </dt>
                    <dd
                        class="flex-1 text-sm leading-5 text-left break-all flex justify-end text-gray-900 dark:text-white font-medium"
                    >
                        {{ session.utm_content }}
                    </dd>
                </div>

                <div
                    v-if="session.utm_term"
                    class="flex items-center px-4 py-2"
                >
                    <dt class="text-sm font-semibold leading-5 text-gray-500">
                        UTM Term
                    </dt>
                    <dd
                        class="flex-1 text-sm leading-5 text-left break-all flex justify-end text-gray-900 dark:text-white font-medium"
                    >
                        {{ session.utm_term }}
                    </dd>
                </div>

                <div
                    v-if="session.unique_id"
                    class="flex items-center px-4 py-2"
                >
                    <dt class="text-sm font-semibold leading-5 text-gray-500">
                        ID
                    </dt>
                    <dd
                        class="flex-1 text-sm leading-5 text-left break-all flex justify-end text-gray-900 dark:text-white font-medium"
                    >
                        {{ session.unique_id }}
                    </dd>
                </div>

                <div v-if="session.name" class="flex items-center px-4 py-2">
                    <dt class="text-sm font-semibold leading-5 text-gray-500">
                        Name
                    </dt>
                    <dd
                        class="flex-1 text-sm leading-5 text-left break-all flex justify-end text-gray-900 dark:text-white font-medium"
                    >
                        {{ session.name }}
                    </dd>
                </div>

                <div v-if="session.email" class="flex items-center px-4 py-2">
                    <dt class="text-sm font-semibold leading-5 text-gray-500">
                        Email
                    </dt>
                    <dd
                        class="flex-1 text-sm leading-5 text-left break-all flex justify-end text-gray-900 dark:text-white font-medium"
                    >
                        {{ session.email }}
                    </dd>
                </div>
            </div>
        </div>
    </div>

    <ConfirmationModal
        :show="beingDeleted"
        @close="beingDeleted = null"
        max-width="sm"
    >
        <template #title> Delete User </template>

        <template #content>
            Are you sure you would like to delete this label?
        </template>

        <template #footer>
            <SecondaryButton color="secondary" @click="beingDeleted = null">
                Cancel
            </SecondaryButton>

            <DangerButton
                @click="deleteUser"
                :class="{
                    'ml-2': true,
                    'opacity-25': deleteForm.processing,
                }"
                :disabled="deleteForm.processing"
            >
                Delete
            </DangerButton>
        </template>
    </ConfirmationModal>
</template>
