<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

import InputError from "@/Components/InputError.vue";
import Label from "@/Components/Label.vue";
import Input from "@/Components/Input.vue";
import Toggle from "@/Components/Toggle.vue";
import Select from "@/Components/Select.vue";
import FormSection from "@/Components/FormSection.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

import SnippetCode from "./SnippetCode.vue";

import { ref, computed } from "vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";

const { website } = defineProps({
    website: Object,
});

const form = useForm({
    name: website.name,
    domain: website.domain,
    public: website.public,
    session_duration: website.session_duration,
});

const updateAccount = () => {
    form.put(route("websites.update", website.id));
};
</script>
<template>
    <AuthenticatedLayout>
        <FormSection @submitted="updateAccount">
            <template #title> Website Settings </template>

            <template #description>
                Update your website name, domain, publicy and more.
            </template>

            <template #form>
                <!-- Name -->
                <div class="col-span-6 sm:col-span-4">
                    <Label for="name" value="Name" />
                    <Input
                        id="name"
                        v-model="form.name"
                        type="text"
                        class="mt-1 block w-full"
                        autocomplete="name"
                        placeholder="My website"
                    />
                    <InputError :message="form.errors.name" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="col-span-6 sm:col-span-4">
                    <Label for="domain" value="Domain" />
                    <Input
                        id="domain"
                        v-model="form.domain"
                        type="text"
                        class="mt-1 block w-full"
                        placeholder="domain.com"
                    />
                    <InputError :message="form.errors.domain" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <Label for="session_duration" value="Session Duration" />
                    <Select
                        id="session_duration"
                        :values="{
                            1: '1 minute',
                            2: '2 minutes',
                            5: '5 minutes',
                            10: '10 minutes',
                            15: '15 minutes',
                            30: '30 minutes',
                            60: '1 hour',
                        }"
                        class="mt-1 block w-full"
                        v-model="form.session_duration"
                    />

                    <InputError
                        :message="form.errors.session_duration"
                        class="mt-2"
                    />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <Toggle
                        id="public"
                        label="Public"
                        v-model:checked="form.public"
                    />

                    <InputError :message="form.errors.public" class="mt-2" />
                </div>
            </template>

            <template #actions>
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Update
                </PrimaryButton>
            </template>
        </FormSection>

        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1 flex justify-between">
                <div class="">
                    <h3
                        class="text-lg font-medium text-gray-900 dark:text-white"
                    >
                        JavaScript Code
                    </h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                        Paste this snippet in the head of your website to start
                        collect data.
                    </p>
                </div>
                <div class=""></div>
            </div>
            <div class="col-span-2">
                <SnippetCode :website="website" :show-description="false" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
