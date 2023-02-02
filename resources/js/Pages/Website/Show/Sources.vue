<template>
    <div class="col-span-6 bg-white p-4">
        <div class="flex items-center justify-between">
            <div>Top Sources</div>
            <div class="flex items-center space-x-1">
                <div
                    @click="mode = 'all'"
                    :class="{
                        'cursor-pointer text-sm': true,
                        'font-semibold': mode == 'all',
                    }"
                >
                    All
                </div>
                <Menu as="div" class="relative inline-block text-left">
                    <div>
                        <MenuButton
                            :class="{
                                'inline-flex w-full justify-center px-4 py-2 text-sm font-medium text-gray-700 focus:outline-none': true,
                                'font-semibold': mode != 'all',
                            }"
                        >
                            {{
                                mode == "all"
                                    ? "Campaigns"
                                    : selectCampaigns.find(
                                          (campaign) => campaign.value == mode
                                      ).name
                            }}
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
                            class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                        >
                            <div class="py-1">
                                <MenuItem
                                    v-for="campaign in selectCampaigns"
                                    :key="campaign"
                                    v-slot="{ active }"
                                >
                                    <div
                                        @click="mode = campaign.value"
                                        :class="[
                                            mode == campaign.value
                                                ? 'bg-gray-100 text-gray-900'
                                                : 'text-gray-700',
                                            'block px-4 py-2 text-sm cursor-pointer',
                                        ]"
                                    >
                                        {{ campaign.name }}
                                    </div>
                                </MenuItem>
                            </div>
                        </MenuItems>
                    </transition>
                </Menu>
            </div>
        </div>
        <div v-if="mode == 'all'" class="mt-4">
            <div class="flex items-center justify-between">
                <div>Source</div>
                <div>Visitors</div>
            </div>
            <ul>
                <li v-for="page in referrers" :key="page">
                    <div class="flex items-center justify-between">
                        <div>
                            {{ page.referrer ? page.referrer : "(None)" }}
                        </div>
                        <div>{{ page.total }}</div>
                    </div>
                </li>
            </ul>
        </div>

        <div v-else-if="mode == 'utm_medium'" class="mt-4">
            <div class="flex items-center justify-between">
                <div>UTM Medium</div>
                <div>Visitors</div>
            </div>
            <ul>
                <li v-for="data in campaigns.utm_mediums" :key="data">
                    <div class="flex items-center justify-between">
                        <div>
                            {{ data.utm_medium }}
                        </div>
                        <div>{{ data.total }}</div>
                    </div>
                </li>
            </ul>
        </div>

        <div v-else-if="mode == 'utm_source'" class="mt-4">
            <div class="flex items-center justify-between">
                <div>UTM Source</div>
                <div>Visitors</div>
            </div>
            <ul>
                <li v-for="data in campaigns.utm_sources" :key="data">
                    <div class="flex items-center justify-between">
                        <div>
                            {{ data.utm_source }}
                        </div>
                        <div>{{ data.total }}</div>
                    </div>
                </li>
            </ul>
        </div>

        <div v-else-if="mode == 'utm_campaign'" class="mt-4">
            <div class="flex items-center justify-between">
                <div>UTM Campaign</div>
                <div>Visitors</div>
            </div>
            <ul>
                <li v-for="data in campaigns.utm_campaigns" :key="data">
                    <div class="flex items-center justify-between">
                        <div>
                            {{ data.utm_campaign }}
                        </div>
                        <div>{{ data.total }}</div>
                    </div>
                </li>
            </ul>
        </div>

        <div v-else-if="mode == 'utm_content'" class="mt-4">
            <div class="flex items-center justify-between">
                <div>UTM Content</div>
                <div>Visitors</div>
            </div>
            <ul>
                <li v-for="data in campaigns.utm_contents" :key="data">
                    <div class="flex items-center justify-between">
                        <div>
                            {{ data.utm_content }}
                        </div>
                        <div>{{ data.total }}</div>
                    </div>
                </li>
            </ul>
        </div>

        <div v-else-if="mode == 'utm_term'" class="mt-4">
            <div class="flex items-center justify-between">
                <div>UTM Term</div>
                <div>Visitors</div>
            </div>
            <ul>
                <li v-for="data in campaigns.utm_terms" :key="data">
                    <div class="flex items-center justify-between">
                        <div>
                            {{ data.utm_term }}
                        </div>
                        <div>{{ data.total }}</div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import { ChevronDownIcon } from "@heroicons/vue/20/solid";

export default {
    name: "Sources",
    components: {
        Menu,
        MenuButton,
        MenuItem,
        MenuItems,
        ChevronDownIcon,
    },
    props: {
        referrers: {
            type: Object,
            required: true,
        },
        campaigns: {
            type: Object,
            required: true,
        },
    },

    data() {
        return {
            mode: "all",
            selectCampaigns: [
                {
                    value: "utm_medium",
                    name: "UTM Medium",
                },
                {
                    value: "utm_source",
                    name: "UTM Source",
                },
                {
                    value: "utm_campaign",
                    name: "UTM Campaign",
                },
                {
                    value: "utm_content",
                    name: "UTM Content",
                },
                {
                    value: "utm_term",
                    name: "UTM Term",
                },
            ],
        };
    },
};
</script>
