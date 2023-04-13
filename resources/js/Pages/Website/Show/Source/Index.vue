<script setup>
import { ref } from "vue";
import { ChevronDownIcon } from "@heroicons/vue/20/solid";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";

import Tab from "@/Components/Tab.vue";
import Referrer from "@/Pages/Website/Show/Source/Referrer.vue";
import Medium from "@/Pages/Website/Show/Source/Medium.vue";
import Source from "@/Pages/Website/Show/Source/Source.vue";
import Campaign from "@/Pages/Website/Show/Source/Campaign.vue";
import Content from "@/Pages/Website/Show/Source/Content.vue";
import Term from "@/Pages/Website/Show/Source/Term.vue";

const { dateRange, website } = defineProps({
    dateRange: Object,
    website: Object,
});

const tabNames = ["Referrer"];
const tabs = { Referrer, Medium, Source, Campaign, Content, Term };
const tab = ref("Referrer");
const campaigns = ["Medium", "Source", "Campaign", "Content", "Term"];

const setTab = (value) => {
    tab.value = value;
};
</script>

<template>
    <div class="col-span-12 lg:col-span-6 card p-4 min-h-[450px]">
        <Tab
            :currentTab="tab"
            :tabs="tabNames"
            @update="setTab"
            title="Top Sources"
        >
            <template #right>
                <Menu as="div" class="relative inline-block text-left">
                    <div>
                        <MenuButton
                            :class="{
                                'ml-2 flex items-center cursor-pointer capitalize text-xs xl:text-base font-semibold border-b-2': true,
                                'text-black dark:text-white border-black dark:border-white':
                                    tab !== 'Referrer',
                                'text-gray-600 dark:text-gray-400 border-transparent':
                                    tab === 'Referrer',
                            }"
                        >
                            {{ tab == "Referrer" ? "All campaigns" : tab }}
                            <ChevronDownIcon
                                class="h-5 w-5"
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
                            class="absolute right-0 z-10 mt-1 w-44 origin-top-right border border-gray-200 dark:border-gray-700 divide-y divide-gray-100 dark:divide-zinc-700 rounded-md bg-white dark:bg-[#303030] shadow-lg focus:outline-none"
                        >
                            <div class="p-1">
                                <MenuItem
                                    v-for="campaign in campaigns"
                                    :key="campaign"
                                    v-slot="{ active }"
                                >
                                    <div
                                        @click="setTab(campaign)"
                                        class="text-gray-700 dark:text-white block px-4 py-2 text-sm cursor-pointer hover:bg-gray-100 dark:hover:bg-zinc-700"
                                    >
                                        {{ campaign }}
                                    </div>
                                </MenuItem>
                            </div>
                        </MenuItems>
                    </transition>
                </Menu>
            </template>
        </Tab>
        <div class="mt-4">
            <component
                :is="tabs[tab]"
                :dateRange="dateRange"
                :website="website"
            />
        </div>
    </div>
</template>
