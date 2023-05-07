<script setup>
import { usePage, Link } from "@inertiajs/vue3";
import { ref, computed, reactive } from "vue";

import {
    Dialog,
    DialogPanel,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";

import { BoltIcon } from "@heroicons/vue/20/solid";

import {
    Bars3Icon,
    Cog6ToothIcon,
    XMarkIcon,
    ArrowTrendingUpIcon,
    UsersIcon,
    CreditCardIcon,
} from "@heroicons/vue/24/outline";

import WebsiteDropdown from "./Components/WebsiteDropdown.vue";
import AccountDropdown from "./Components/AccountDropdown.vue";

import ModalUpgrade from "@/Pages/App/Billing/ModalUpgrade.vue";

const showingNavigationDropdown = ref(false);
const modalUpgrade = ref(null);

const sidebarOpen = ref(false);
const user = usePage().props.auth.user;
const selfHosted = usePage().props.self_hosted;

const navigation = [
    {
        name: "Analytics",
        href: route("analytics"),
        icon: ArrowTrendingUpIcon,
        current: route().current("analytics"),
        show: true,
    },
    {
        name: "Users",
        href: route("users.index"),
        icon: UsersIcon,
        current: route().current("users.*"),
        show: true,
    },
    {
        name: "Settings",
        href: route("websites.edit"),
        icon: Cog6ToothIcon,
        current: route().current("websites.edit"),
        show: true,
    },
    {
        name: "Billing",
        href: route("billing.index"),
        icon: CreditCardIcon,
        current: false,
        show: !selfHosted,
    },
];

const openModalUpgrade = () => {
    modalUpgrade.value.open();
    sidebarOpen.value = false;
};
</script>

<template>
    <TransitionRoot as="template" :show="sidebarOpen">
        <Dialog
            as="div"
            class="relative z-50 lg:hidden"
            @close="sidebarOpen = false"
        >
            <TransitionChild
                as="template"
                enter="transition-opacity ease-linear duration-300"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="transition-opacity ease-linear duration-300"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-zinc-900/80" />
            </TransitionChild>

            <div class="fixed inset-0 flex">
                <TransitionChild
                    as="template"
                    enter="transition ease-in-out duration-300 transform"
                    enter-from="-translate-x-full"
                    enter-to="translate-x-0"
                    leave="transition ease-in-out duration-300 transform"
                    leave-from="translate-x-0"
                    leave-to="-translate-x-full"
                >
                    <DialogPanel
                        class="relative mr-16 flex w-full max-w-xs flex-1"
                    >
                        <TransitionChild
                            as="template"
                            enter="ease-in-out duration-300"
                            enter-from="opacity-0"
                            enter-to="opacity-100"
                            leave="ease-in-out duration-300"
                            leave-from="opacity-100"
                            leave-to="opacity-0"
                        >
                            <div
                                class="absolute left-full top-0 flex w-16 justify-center pt-5"
                            >
                                <button
                                    type="button"
                                    class="-m-2.5 p-2.5"
                                    @click="sidebarOpen = false"
                                >
                                    <span class="sr-only">Close sidebar</span>
                                    <XMarkIcon
                                        class="h-6 w-6 text-white"
                                        aria-hidden="true"
                                    />
                                </button>
                            </div>
                        </TransitionChild>
                        <!-- Sidebar component, swap this element with another sidebar if you like -->
                        <div
                            class="flex grow flex-col gap-y-5 overflow-y-auto bg-zinc-800 px-6 py-4 ring-1 ring-white/10"
                        >
                            <WebsiteDropdown />
                            <nav class="flex flex-1 flex-col">
                                <ul
                                    role="list"
                                    class="flex flex-1 flex-col gap-y-7"
                                >
                                    <li>
                                        <ul role="list" class="-mx-2 space-y-1">
                                            <li
                                                v-for="item in navigation"
                                                :key="item.name"
                                            >
                                                <Link
                                                    :href="item.href"
                                                    :class="{
                                                        'bg-zinc-900 text-white':
                                                            item.current,
                                                        'text-zinc-400 hover:text-white hover:bg-zinc-900':
                                                            !item.current,
                                                        'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold': true,
                                                        hidden: !item.show,
                                                    }"
                                                >
                                                    <component
                                                        :is="item.icon"
                                                        class="h-6 w-6 shrink-0"
                                                        aria-hidden="true"
                                                    />
                                                    {{ item.name }}
                                                </Link>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <ul class="mt-auto">
                                    <li>
                                        <AccountDropdown />
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </DialogPanel>
                </TransitionChild>
            </div>
        </Dialog>
    </TransitionRoot>

    <!-- Static sidebar for desktop -->
    <div
        class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col"
    >
        <div
            class="flex grow flex-col gap-y-5 overflow-y-auto bg-zinc-800 px-6 py-4"
        >
            <WebsiteDropdown />
            <nav class="flex flex-1 flex-col">
                <ul role="list" class="flex flex-1 flex-col gap-y-8">
                    <li>
                        <ul role="list" class="-mx-2 space-y-1">
                            <li v-for="item in navigation" :key="item.name">
                                <Link
                                    :href="item.href"
                                    :class="{
                                        'bg-zinc-900 text-white': item.current,
                                        'text-zinc-400 hover:text-white hover:bg-zinc-900':
                                            !item.current,
                                        'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold': true,
                                        hidden: !item.show,
                                    }"
                                >
                                    <component
                                        :is="item.icon"
                                        class="h-6 w-6 shrink-0"
                                        aria-hidden="true"
                                    />
                                    {{ item.name }}
                                </Link>
                            </li>
                        </ul>
                    </li>

                    <ul class="mt-auto">
                        <li>
                            <AccountDropdown />
                        </li>
                    </ul>
                </ul>
            </nav>
        </div>
    </div>

    <div
        class="sticky top-0 z-40 flex items-center gap-x-6 bg-zinc-900 px-4 py-4 shadow-sm sm:px-6 lg:hidden"
    >
        <button
            type="button"
            class="-m-2.5 p-2.5 text-zinc-400 lg:hidden"
            @click="sidebarOpen = true"
        >
            <span class="sr-only">Open sidebar</span>
            <Bars3Icon class="h-6 w-6" aria-hidden="true" />
        </button>
    </div>

    <ModalUpgrade ref="modalUpgrade" />
</template>
