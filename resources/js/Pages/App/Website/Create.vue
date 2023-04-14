<script setup>
import GuestLayout from "@/Layouts/Auth/Master.vue";
import InputError from "@/Components/InputError.vue";
import Label from "@/Components/Label.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/Input.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    domain: "",
});

const user = usePage().props.auth.user;

const submit = () => {
    form.post(route("websites.store"), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="New Website" />

        <form @submit.prevent="submit">
            <h1
                class="text-2xl font-extrabold text-center text-black dark:text-white mb-4"
            >
                New Website
            </h1>
            <div>
                <Label for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    placeholder="My Website"
                    autocomplete="off"
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <Label for="domain" value="Domain" />

                <TextInput
                    id="domain"
                    type="text"
                    class="mt-1 block w-full"
                    placeholder="domain.com"
                    v-model="form.domain"
                    required
                />

                <InputError class="mt-2" :message="form.errors.domain" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    v-if="user.websites.length > 0"
                    :href="route('analytics')"
                    class="underline text-sm text-gray-600 hover:text-gray-900"
                >
                    Cancel
                </Link>
                <PrimaryButton
                    class="ml-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Create
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
