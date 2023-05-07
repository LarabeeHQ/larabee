<script setup>
import { ref } from "vue";
import { Link, Head, usePage, useForm } from "@inertiajs/vue3";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import AuthenticatedLayout from "@/Layouts/App/Master.vue";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import { ChevronLeftIcon } from "@heroicons/vue/24/outline";

const website = usePage().props.auth.user.current_website;

const { session } = defineProps({
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

const formatDate = (date) => {
    return dayjs(date).format("MMMM D, YYYY h:mm A");
};
</script>
<template>
    <AuthenticatedLayout>
        <Head title="Users" />

        <div class="min-w-0 flex-1 mb-4">
            <div class="">
                <Link
                    class="-ml-3 inline-flex items-center font-medium space-x-1 mb-2 hover:bg-white rounded-md px-2.5 py-1.5"
                    :href="route('users.index')"
                >
                    <ChevronLeftIcon class="h-4 w-4 stroke-2" />
                    <div>Back</div>
                </Link>
                <h1 class="h1">Users</h1>
                <div class="text-sm font-medium text-zinc-800 dark:text-white">
                    {{ website.domain }}
                </div>
            </div>
        </div>
        <div class="grid grid-cols-5 gap-8">
            <div class="col-span-3">
                <div class="card divide-y divider-gray-100">
                    <div
                        v-for="page_view in session.page_views"
                        :key="page_view.id"
                    >
                        <div></div>
                        <div>
                            {{ page_view.url }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-2">
                <div>{{ session.id }}</div>
                <div class="flex items-center space-x-2">
                    <div class="flex items-center space-x-2">
                        <img
                            :src="`https://flagcdn.com/16x12/${session.country.toLowerCase()}.png`"
                            :alt="session.country"
                        />
                        <div>{{ session.country }}</div>
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

                <div @click="confirmDeletion(session.id)">Delete</div>
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
    </AuthenticatedLayout>
</template>
