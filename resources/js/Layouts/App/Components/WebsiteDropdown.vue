<script setup>
import { usePage, Link, router } from "@inertiajs/vue3";

import { ChevronDownIcon, PlusIcon } from "@heroicons/vue/20/solid";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";

const websites = usePage().props.auth.user.websites;
const currentWebsite = usePage().props.auth.user.current_website;

const switchToWebsite = (website) => {
    router.put(
        route("websites.update-current"),
        {
            website_id: website.id,
        },
        {
            preserveState: false,
        }
    );
};
</script>
<template>
    <Menu as="div" class="relative inline-block text-left">
        <div>
            <MenuButton
                class="flex w-full justify-between gap-x-1.5 rounded-md text-zinc-400 border bg-zinc-800 border-zinc-700 px-3 py-2 text-sm font-semibold"
            >
                <div class="flex items-center space-x-2">
                    <img
                        :src="`https://www.google.com/s2/favicons?domain=${currentWebsite.domain}&sz=128`"
                        class="w-4 h-4"
                        :alt="currentWebsite.name"
                    />
                    <div>
                        {{ currentWebsite.name }}
                    </div>
                </div>
                <ChevronDownIcon
                    class="-mr-1 h-5 w-5 text-gray-400"
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
                class="absolute right-0 z-10 mt-1 w-full origin-top-right border border-gray-700 divide-y divide-zinc-700 rounded-md bg-[#303030] shadow-lg focus:outline-none"
            >
                <div class="py-1">
                    <MenuItem
                        v-for="website in websites"
                        :key="website"
                        v-slot="{ active }"
                    >
                        <div
                            @click="switchToWebsite(website)"
                            class="font-medium text-white block px-4 py-2 text-sm cursor-pointer hover:bg-zinc-700"
                        >
                            <div class="flex items-center space-x-2">
                                <img
                                    :src="`https://www.google.com/s2/favicons?domain=${website.domain}&sz=128`"
                                    class="w-4 h-4"
                                    :alt="website.name"
                                />
                                <div>
                                    {{ website.name }}
                                </div>
                            </div>
                        </div>
                    </MenuItem>
                </div>
                <div class="py-1">
                    <MenuItem v-slot="{ active }">
                        <Link
                            :href="route('websites.create')"
                            class="text-white block px-4 py-2 text-sm cursor-pointer hover:bg-zinc-700"
                        >
                            <div class="flex items-center space-x-2">
                                <PlusIcon class="h-4 w-4 text-white stroke-2" />
                                <div class="font-medium">New Website</div>
                            </div>
                        </Link>
                    </MenuItem>
                </div>
            </MenuItems>
        </transition>
    </Menu>
</template>
