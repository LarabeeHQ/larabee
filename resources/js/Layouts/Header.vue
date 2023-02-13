<script setup>
import { computed, ref, onMounted } from "vue";
// import ModalUpgrade from "@/Pages/Billing/ModalUpgrade.vue";

import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";

import { MoonIcon, SunIcon } from "@heroicons/vue/20/solid";
import { UserCircleIcon } from "@heroicons/vue/24/outline";

const darkMode = ref(false);
const user = computed(() => usePage().props.auth.user);
const selfHosted = computed(() => usePage().props.self_hosted);

const showingNavigationDropdown = ref(false);
const modalUpgrade = ref(null);

onMounted(() => {
    // if (darkMode.value) {
    //     document.documentElement.classList.add("dark");
    // } else {
    //     document.documentElement.classList.remove("dark");
    // }
});

const toggleDarkMode = () => {
    // darkMode.value = !darkMode.value;
    // localStorage.setItem("theme", darkMode.value ? "dark" : "light");
    // if (darkMode.value) {
    //     document.documentElement.classList.add("dark");
    // } else {
    //     document.documentElement.classList.remove("dark");
    // }
};

const openModalUpgrade = () => {
    modalUpgrade.value.open();
};
</script>

<template>
    <nav
        v-if="user"
        class="bg-zinc-100 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700"
    >
        <!-- Primary Navigation Menu -->
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <Link :href="route('websites.index')">
                            <ApplicationLogo class="block h-9 w-auto" />
                        </Link>
                    </div>

                    <!-- Navigation Links -->
                    <div
                        class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex items-center"
                    >
                        <div></div>
                    </div>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ml-6 space-x-2">
                    <!-- <button
                        v-if="!selfHosted && user.is_trial"
                        @click="openModalUpgrade"
                        type="button"
                        class="flex items-center space-x-2 rounded-md border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-zinc-700 dark:text-white hover:bg-zinc-50 px-4 py-2 text-sm font-medium focus:outline-none"
                    >
                        <div>Upgrade</div>
                        <div>🚀</div>
                    </button>

                    <button
                        @click="toggleDarkMode"
                        type="button"
                        class="inline-flex w-full justify-center px-2 py-2 focus:outline-none"
                    >
                        <div v-if="!darkMode" class="">
                            <MoonIcon class="h-6 w-6 stroke-2 text-black" />
                        </div>
                        <div v-else class="">
                            <SunIcon class="h-6 w-6 stroke-2 text-white" />
                        </div>
                    </button>

                    <div class="relative">
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <span class="inline-flex rounded-md">
                                    <button
                                        type="button"
                                        class="inline-flex w-full justify-center px-2 py-2 focus:outline-none"
                                    >
                                        <UserCircleIcon
                                            class="h-6 w-6 stroke-2 text-black dark:text-white"
                                        />
                                    </button>
                                </span>
                            </template>

                            <template #content>
                                <DropdownLink :href="route('account.edit')">
                                    Profile
                                </DropdownLink>

                                <DropdownLink
                                    v-if="!selfHosted"
                                    :href="route('billing.index')"
                                >
                                    Billing
                                </DropdownLink>
                                <DropdownLink
                                    :href="route('logout')"
                                    method="post"
                                    as="button"
                                >
                                    Log Out
                                </DropdownLink>
                            </template>
                        </Dropdown>
                    </div> -->
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <!-- <button
                        @click="
                            showingNavigationDropdown =
                                !showingNavigationDropdown
                        "
                        class="inline-flex items-center justify-center p-2 rounded-md text-zinc-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                    >
                        <svg
                            class="h-6 w-6"
                            stroke="currentColor"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <path
                                :class="{
                                    hidden: showingNavigationDropdown,
                                    'inline-flex': !showingNavigationDropdown,
                                }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                            <path
                                :class="{
                                    hidden: !showingNavigationDropdown,
                                    'inline-flex': showingNavigationDropdown,
                                }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button> -->
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div
            :class="{
                block: showingNavigationDropdown,
                hidden: !showingNavigationDropdown,
            }"
            class="sm:hidden"
        >
            <div class="pt-2 pb-3 space-y-1">
                <ResponsiveNavLink
                    :href="route('websites.create')"
                    :active="route().current('websites.*')"
                >
                    Websites
                </ResponsiveNavLink>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">
                        {{ user.name }}
                    </div>
                    <div class="font-medium text-sm text-gray-500">
                        {{ user.email }}
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <ResponsiveNavLink :href="route('account.edit')">
                        Profile
                    </ResponsiveNavLink>
                    <ResponsiveNavLink
                        :href="route('logout')"
                        method="post"
                        as="button"
                    >
                        Log Out
                    </ResponsiveNavLink>
                </div>
            </div>
        </div>
    </nav>

    <!-- <ModalUpgrade ref="modalUpgrade" /> -->
</template>
