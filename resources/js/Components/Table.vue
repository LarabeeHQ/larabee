<script setup>
import countryHelper from "@/countryHelper";
import helper from "@/helper";
import { onMounted, ref, computed } from "vue";

const total = ref(0);

const { data, country, favicon } = defineProps({
    data: Object,
    favicon: {
        type: Boolean,
        default: false,
    },
    country: {
        type: Boolean,
        default: false,
    },

    capitalize: {
        type: Boolean,
        default: false,
    },

    uppercase: {
        type: Boolean,
        default: false,
    },
});

const formatName = (name) => {
    return country ? countryHelper.getCountryName(name) : name;
};

onMounted(async () => {
    total.value = helper.calcTotal(data);
});
</script>

<template>
    <div v-if="data.length >= 1">
        <div class="space-y-2 relative">
            <div
                v-for="value in data"
                :key="value"
                class="relative w-full group"
            >
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <!-- <div
                            :class="`absolute top-0 left-0 h-full dark:bg-opacity-20 rounded-r-md bg-gray-100 dark:bg-gray-500`"
                            :style="`max-width: 85%; width: ${helper.calcPercentage(
                                total,
                                value.y
                            )}%`"
                        ></div> -->
                        <div class="flex items-center space-x-2 z-10 px-2 py-1">
                            <img
                                v-if="favicon"
                                :src="`https://www.google.com/s2/favicons?domain=${value.x}&sz=128`"
                                class="w-4 h-4"
                                :alt="value.x"
                            />

                            <img
                                v-if="country"
                                :src="`https://flagcdn.com/16x12/${value.x.toLowerCase()}.png`"
                                :alt="value.x"
                            />

                            <div
                                :class="{
                                    'text-gray-800 dark:text-white text-sm font-semibold': true,
                                    capitalize: capitalize,
                                    uppercase: uppercase,
                                }"
                            >
                                {{ formatName(value.x) }}
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between min-w-[3rem]">
                        <!-- <div
                            class="invisible group-hover:visible flex text-xs font-semibold text-gray-500 dark:hover:text-gray-300"
                        >
                            {{ helper.calcPercentage(total, value.y) }}%
                        </div>
                        <div
                            class="text-sm font-semibold text-gray-800 dark:text-white"
                        >
                            {{ helper.kFormatter(value.y) }}
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div
        v-else
        class="min-h-[300px] flex flex-col sm:justify-center items-center"
    >
        <div class="text-zinc-800 dark:text-zinc-300 font-medium text-sm">
            No data
        </div>
    </div>
</template>
