<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
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
                <div class="">First Visit</div>
                <div
                    v-if="session.first_page_view.referrer"
                    class="flex items-center px-4 py-2"
                >
                    <dt class="text-sm font-medium leading-5 text-gray-500">
                        Referrer
                    </dt>
                    <dd
                        class="flex-1 text-sm leading-5 text-left break-all flex justify-end text-gray-900 over-limit"
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
            </div>
        </div>
        <!-- <div class="flex items-center space-x-2">
            <div class="flex items-center space-x-2">
                <div>
                    {{ countryHelper.getCountryFlag(session.country) }}
                </div>
                <div>
                    {{ countryHelper.getCountryName(session.country) }}
                </div>
            </div>
            <div>{{ session.browser }}</div>
            <div>{{ session.os }}</div>
        </div>
        <div>
            <div>First visit</div>
            <div>
                <div>Referrer</div>
                <div>{{ session.first_page_view.referrer }}</div>
            </div>
        </div>

        <div @click="confirmDeletion(session.id)">Delete</div> -->
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
