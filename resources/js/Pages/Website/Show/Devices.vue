<template>
    <div class="col-span-6 bg-white p-4">
        <div class="flex items-center justify-between">
            <div>Devices</div>
            <div class="flex items-center space-x-1">
                <div
                    @click="mode = 'devices'"
                    :class="{
                        'cursor-pointer text-sm': true,
                        'font-semibold': mode == 'devices',
                    }"
                >
                    Devices
                </div>

                <div
                    @click="mode = 'browsers'"
                    :class="{
                        'cursor-pointer text-sm': true,
                        'font-semibold': mode == 'browsers',
                    }"
                >
                    Browsers
                </div>

                <div
                    @click="mode = 'os'"
                    :class="{
                        'cursor-pointer text-sm': true,
                        'font-semibold': mode == 'os',
                    }"
                >
                    OS
                </div>
            </div>
        </div>
        <div v-if="mode == 'devices'" class="mt-4">
            <div class="flex items-center justify-between">
                <div>Screen Size</div>
                <div>Visitors</div>
            </div>
            <ul>
                <li v-for="data in devices" :key="data">
                    <div class="flex items-center justify-between">
                        <div>
                            {{ data.device }}
                        </div>
                        <div>{{ data.total }}</div>
                    </div>
                </li>
            </ul>
        </div>

        <div v-else-if="mode == 'browsers'" class="mt-4">
            <div class="flex items-center justify-between">
                <div>Browsers</div>
                <div>Visitors</div>
            </div>
            <ul>
                <li v-for="data in browsers" :key="data">
                    <div class="flex items-center justify-between">
                        <div>
                            {{ data.browser }}
                        </div>
                        <div>{{ data.total }}</div>
                    </div>
                </li>
            </ul>
        </div>

        <div v-else-if="mode == 'os'" class="mt-4">
            <div class="flex items-center justify-between">
                <div>OS</div>
                <div>Visitors</div>
            </div>

            <ul>
                <li v-for="oSystem in os" :key="oSystem">
                    <div class="flex items-center justify-between">
                        <div>
                            {{ oSystem.os }}
                        </div>
                        <div>{{ oSystem.total }}</div>
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
        browsers: {
            type: Object,
            required: true,
        },
        os: {
            type: Object,
            required: true,
        },
        devices: {
            type: Object,
            required: true,
        },
    },

    data() {
        return {
            mode: "devices",
        };
    },
};
</script>
