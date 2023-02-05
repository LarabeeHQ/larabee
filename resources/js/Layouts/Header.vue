<script setup>
import { onMounted, ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";

import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import { ChevronDownIcon, MoonIcon, SunIcon } from "@heroicons/vue/20/solid";
import { UserCircleIcon } from "@heroicons/vue/24/outline";

const darkMode = ref(localStorage.getItem("theme") == "dark" ? true : false);
const user = usePage().props.auth.user;
const websites = user.websites;
const currentWebsite = user.current_website;
const showingNavigationDropdown = ref(false);

const switchToWebsite = (website) => {
    const form = useForm({
        website_id: website.id,
    }).put(route("websites.update-current"));
};

onMounted(() => {
    if (darkMode.value) {
        document.documentElement.classList.add("dark");
    } else {
        document.documentElement.classList.remove("dark");
    }
});

const toggleDarkMode = () => {
    darkMode.value = !darkMode.value;
    localStorage.setItem("theme", darkMode.value ? "dark" : "light");

    if (darkMode.value) {
        document.documentElement.classList.add("dark");
    } else {
        document.documentElement.classList.remove("dark");
    }
};
</script>

<template>
    <nav class="bg-gray-100 dark:bg-black">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <Link :href="route('dashboard')">
                            <ApplicationLogo
                                class="block h-9 w-auto fill-current text-gray-800"
                            />
                        </Link>
                    </div>

                    <!-- Navigation Links -->
                    <div
                        class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex items-center"
                    >
                        <div>
                            <Menu
                                as="div"
                                class="relative inline-block text-left"
                            >
                                <div>
                                    <MenuButton
                                        class="inline-flex w-full truncate justify-center rounded-md bg-white dark:bg-gray-900 px-4 py-2 text-sm font-medium text-gray-700 dark:text-white shadow-sm hover:bg-gray-50 focus:outline-none"
                                    >
                                        {{ currentWebsite.name }}
                                        <ChevronDownIcon
                                            class="-mr-1 ml-2 h-5 w-5"
                                            aria-hidden="true"
                                        />
                                    </MenuButton>
                                </div>

                                <transition
                                    enter-active-class="transition ease-out duration-100"
                                    enter-from-class="transform opacity-0 scale-95"
                                    enter-to-class="transform opacity-100 scale-100"
                                    leave-active-class="transition ease-in duration-75"
                                    leave-from-class="transform opacity-100 scale-100"
                                    leave-to-class="transform opacity-0 scale-95"
                                >
                                    <MenuItems
                                        class="absolute left-0 z-10 mt-2 w-56 origin-top-left divide-y divide-gray-100 dark:divide-gray-800 rounded-md bg-white dark:bg-[#181717] shadow-lg focus:outline-none"
                                    >
                                        <div class="py-1">
                                            <MenuItem
                                                v-for="website in websites"
                                                :key="website"
                                                v-slot="{ active }"
                                            >
                                                <form
                                                    @submit.prevent="
                                                        switchToWebsite(website)
                                                    "
                                                >
                                                    <button
                                                        class="block px-4 py-2 w-full text-left"
                                                    >
                                                        <div
                                                            class="text-sm font-semibold text-gray-700 dark:text-white"
                                                        >
                                                            {{ website.name }}
                                                        </div>
                                                        <div
                                                            class="text-xs text-gray-700 dark:text-gray-300"
                                                        >
                                                            {{ website.domain }}
                                                        </div>
                                                    </button>
                                                </form>
                                            </MenuItem>
                                        </div>
                                        <div class="py-1">
                                            <MenuItem v-slot="{ active }">
                                                <Link
                                                    :href="
                                                        route('websites.create')
                                                    "
                                                    class="block px-4 py-2 w-full text-left text-sm font-semibold text-gray-700 dark:text-white"
                                                >
                                                    Add Website
                                                </Link>
                                            </MenuItem>
                                        </div>
                                    </MenuItems>
                                </transition>
                            </Menu>
                        </div>
                    </div>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <button
                        @click="toggleDarkMode"
                        type="button"
                        class="inline-flex w-full justify-center px-2 py-2 focus:outline-none"
                    >
                        <div v-if="!darkMode" class="">
                            <MoonIcon
                                class="mr-2 h-6 w-6 stroke-2 text-black"
                            />
                        </div>
                        <div v-else class="">
                            <SunIcon class="mr-2 h-6 w-6 stroke-2 text-white" />
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

                                <DropdownLink :href="route('billing.index')">
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

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button
                        @click="
                            showingNavigationDropdown =
                                !showingNavigationDropdown
                        "
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
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
                    </button>
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
                        {{ $page.props.auth.user.name }}
                    </div>
                    <div class="font-medium text-sm text-gray-500">
                        {{ $page.props.auth.user.email }}
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
</template>
