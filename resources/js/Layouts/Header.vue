<script setup>
import { Bars3Icon, BellIcon, XMarkIcon } from "@heroicons/vue/24/outline";

import { computed, onMounted, ref, watch } from "vue";
import ModalUpgrade from "@/Pages/Billing/ModalUpgrade.vue";

import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";

import { MoonIcon, SunIcon } from "@heroicons/vue/20/solid";
import { UserCircleIcon } from "@heroicons/vue/24/outline";

const darkMode = ref(localStorage.getItem("theme") == "dark" ? true : false);
const user = computed(() => usePage().props.auth.user);
const selfHosted = computed(() => usePage().props.self_hosted);

const showingNavigationDropdown = ref(false);
const modalUpgrade = ref(null);

onMounted(() => {
    setTheme(user.value.theme);

    if (user.value.theme == "system") {
        // listen for system theme changes
        window
            .matchMedia("(prefers-color-scheme: dark)")
            .addEventListener("change", (event) => {
                if (event.matches) {
                    document.documentElement.classList.add("dark");
                } else {
                    document.documentElement.classList.remove("dark");
                }
            });
    }
});

const setTheme = (theme) => {
    if (theme == "dark") {
        document.documentElement.classList.add("dark");
    } else if (theme == "light") {
        document.documentElement.classList.remove("dark");
    } else if (theme == "system") {
        if (
            window.matchMedia &&
            window.matchMedia("(prefers-color-scheme: dark)").matches
        ) {
            document.documentElement.classList.add("dark");
        } else {
            document.documentElement.classList.remove("dark");
        }
    }
};

watch(user, () => {
    if (user.value.theme == "dark") {
        setTheme("dark");
    } else if (user.value.theme == "light") {
        setTheme("light");
    } else if (user.value.theme == "system") {
        setTheme("system");
    }
});

const openModalUpgrade = () => {
    modalUpgrade.value.open();
};
</script>

<template>
    <div class="bg-zinc-100 dark:bg-zinc-900">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="flex flex-shrink-0 items-center">
                    <Link :href="route('websites.index')">
                        <ApplicationLogo class="block h-9 w-auto" />
                    </Link>
                </div>
                <div
                    class="absolute inset-y-0 right-0 flex items-center sm:static sm:inset-auto space-x-2"
                >
                    <button
                        v-if="!selfHosted && user.plan.name == 'trial'"
                        @click="openModalUpgrade"
                        type="button"
                        class="flex items-center space-x-2 rounded-md border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-zinc-700 dark:text-white hover:bg-zinc-50 px-3 xl:px-4 py-2 text-sm font-medium focus:outline-none"
                    >
                        <div>Upgrade</div>
                        <div class="hidden xl:flex">🚀</div>
                    </button>

                    <Dropdown align="right" width="36">
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
                </div>
            </div>
        </div>
    </div>

    <ModalUpgrade ref="modalUpgrade" />
</template>
