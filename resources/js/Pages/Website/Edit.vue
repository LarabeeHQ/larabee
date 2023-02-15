<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

import InputError from "@/Components/InputError.vue";
import Label from "@/Components/Label.vue";
import Input from "@/Components/Input.vue";
import Toggle from "@/Components/Toggle.vue";
import FormSection from "@/Components/FormSection.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

import { ref, computed } from "vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";

const { website } = defineProps({
    website: Object,
});

const form = useForm({
    name: website.name,
    domain: website.domain,
    public: website.public,
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
                    <Toggle
                        id="published"
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
    </AuthenticatedLayout>
</template>
