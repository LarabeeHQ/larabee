<template>
    <div class="col-span-6 bg-white p-4">
        <div class="flex items-center justify-between">
            <div>Locations</div>
            <div class="flex items-center space-x-1">
                <div
                    @click="mode = 'countries'"
                    :class="{
                        'cursor-pointer text-sm': true,
                        'font-semibold': mode == 'countries',
                    }"
                >
                    Countries
                </div>

                <div
                    @click="mode = 'regions'"
                    :class="{
                        'cursor-pointer text-sm': true,
                        'font-semibold': mode == 'regions',
                    }"
                >
                    Regions
                </div>

                <div
                    @click="mode = 'cities'"
                    :class="{
                        'cursor-pointer text-sm': true,
                        'font-semibold': mode == 'cities',
                    }"
                >
                    Cities
                </div>
            </div>
        </div>

        <div v-if="mode == 'countries'" class="mt-4">
            <div class="flex items-center justify-between">
                <div>Country</div>
                <div>Visitors</div>
            </div>
            <ul>
                <li v-for="data in countries" :key="data">
                    <div class="flex items-center justify-between">
                        <div>
                            {{ data.country }}
                        </div>
                        <div>{{ data.total }}</div>
                    </div>
                </li>
            </ul>
        </div>

        <div v-else-if="mode == 'regions'" class="mt-4">
            <div class="flex items-center justify-between">
                <div>Region</div>
                <div>Visitors</div>
            </div>
            <ul>
                <li v-for="data in regions" :key="data">
                    <div class="flex items-center justify-between">
                        <div>
                            {{ data.region }}
                        </div>
                        <div>{{ data.total }}</div>
                    </div>
                </li>
            </ul>
        </div>

        <div v-else-if="mode == 'cities'" class="mt-4">
            <div class="flex items-center justify-between">
                <div>City</div>
                <div>Visitors</div>
            </div>

            <ul>
                <li v-for="data in cities" :key="data">
                    <div class="flex items-center justify-between">
                        <div>
                            {{ data.city }}
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
        countries: {
            type: Object,
            required: true,
        },
        regions: {
            type: Object,
            required: true,
        },
        cities: {
            type: Object,
            required: true,
        },
    },

    data() {
        return {
            mode: "countries",
        };
    },
};
</script>
