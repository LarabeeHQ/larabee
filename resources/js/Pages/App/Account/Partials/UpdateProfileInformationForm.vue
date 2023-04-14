<script setup>
import InputError from "@/Components/InputError.vue";
import Label from "@/Components/Label.vue";
import FormSection from "@/Components/FormSection.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Input from "@/Components/Input.vue";
import Select from "@/Components/Select.vue";
import { ref, computed } from "vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";

defineProps({
    mustVerifyEmail: Boolean,
    status: String,
    timezones: Object,
});

const user = computed(() => usePage().props.auth.user);

const form = useForm({
    name: user.value.name,
    email: user.value.email,
    timezone_id: user.value.timezone_id,
    theme: user.value.theme,
});

const verificationLinkSent = ref(null);

const updateAccount = () => {
    form.post(route("account.update"), {
        errorBag: "updateAccount",
        preserveScroll: true,
    });
};

const sendEmailVerification = () => {
    verificationLinkSent.value = true;
};
</script>

<template>
    <FormSection @submitted="updateAccount">
        <template #title> Account Information </template>

        <template #description>
            Update your account's name, email address and timezone.
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
                    placeholder="Your name"
                />
                <InputError :message="form.errors.name" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <Label for="email" value="Email" />
                <Input
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    placeholder="Your email"
                />
                <InputError :message="form.errors.email" class="mt-2" />

                <div v-if="user.email_verified_at === null">
                    <p class="text-sm mt-2">
                        Your email address is unverified.

                        <Link
                            :href="route('verification.send')"
                            method="post"
                            as="button"
                            class="underline text-gray-600 hover:text-gray-900"
                            @click.prevent="sendEmailVerification"
                        >
                            Click here to re-send the verification email.
                        </Link>
                    </p>

                    <div
                        v-show="verificationLinkSent"
                        class="mt-2 font-medium text-sm text-green-600"
                    >
                        A new verification link has been sent to your email
                        address.
                    </div>
                </div>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <Label for="theme" value="Theme" />
                <Select
                    id="theme"
                    :placeholder="false"
                    :values="{ LIGHT: 'Light', DARK: 'Dark', SYSTEM: 'System' }"
                    class="mt-1 block w-full"
                    v-model="form.theme"
                />

                <InputError :message="form.errors.theme" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <Label for="timezone_id" value="Timezone" />
                <Select
                    id="timezone_id"
                    :values="timezones"
                    class="mt-1 block w-full"
                    v-model="form.timezone_id"
                />

                <InputError :message="form.errors.timezone_id" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <PrimaryButton
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Save
            </PrimaryButton>
        </template>
    </FormSection>
</template>
