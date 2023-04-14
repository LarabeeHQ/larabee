<script setup>
import { usePage, Link } from "@inertiajs/vue3";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";

import {
    UserCircleIcon,
    Cog6ToothIcon,
    CreditCardIcon,
    PowerIcon,
    LifebuoyIcon,
} from "@heroicons/vue/24/outline";
</script>
<template>
    <Menu as="div" class="relative inline-block text-left w-full">
        <div class="w-full">
            <MenuButton
                class="w-full group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-zinc-400 hover:bg-zinc-800 hover:text-white"
            >
                <UserCircleIcon class="h-6 w-6 shrink-0" />
                Account
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
                class="absolute bottom-10 z-10 mt-1 w-full origin-bottom-right border border-gray-700 divide-y divide-zinc-700 rounded-md bg-[#303030] shadow-lg focus:outline-none"
            >
                <div class="py-1">
                    <MenuItem v-slot="{ active }">
                        <Link
                            :href="route('account.edit')"
                            class="text-white px-4 py-2 text-sm cursor-pointer hover:bg-zinc-700 font-medium flex items-center space-x-2"
                        >
                            <UserCircleIcon class="h-5 w-5 stroke-2" />
                            <div>Account</div>
                        </Link>
                    </MenuItem>
                </div>

                <div class="py-1">
                    <MenuItem v-slot="{ active }">
                        <a
                            href="https://docs.wanalytics.io"
                            target="_blank"
                            class="text-white px-4 py-2 text-sm cursor-pointer hover:bg-zinc-700 font-medium flex items-center space-x-2"
                        >
                            <LifebuoyIcon class="h-5 w-5" />
                            <div>Documentation</div>
                        </a>
                    </MenuItem>
                </div>

                <div class="py-1">
                    <MenuItem v-slot="{ active }">
                        <Link
                            :href="route('logout')"
                            method="post"
                            as="button"
                            class="w-full text-white px-4 py-2 text-sm cursor-pointer hover:bg-zinc-700 font-medium flex items-center space-x-2"
                        >
                            <PowerIcon class="h-5 w-5" />

                            <div>Logout</div>
                        </Link>
                    </MenuItem>
                </div>
            </MenuItems>
        </transition>
    </Menu>
</template>
