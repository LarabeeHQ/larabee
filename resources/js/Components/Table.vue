<script setup>
import helper from "@/helper";
import { onMounted, ref, computed } from "vue";

const total = ref(0);

const { data, progressBarColor, country, favicon } = defineProps({
    data: Object,
    favicon: {
        type: Boolean,
        default: false,
    },
    country: {
        type: Boolean,
        default: false,
    },

    progressBarColor: {
        type: String,
        default: "gray",
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

const colorClass = computed(() => {
    return {
        gray: "bg-gray-100 dark:bg-gray-500",
        blue: "bg-blue-100 dark:bg-blue-500",
        green: "bg-emerald-100 dark:bg-green-500",
        orange: "bg-orange-100 dark:bg-orange-500",
        red: "bg-red-100 dark:bg-red-500",
        pink: "bg-pink-100 dark:bg-pink-500",
    }[progressBarColor];
});

onMounted(async () => {
    total.value = helper.calcTotal(data);
});
</script>

<template>
    <div>
        <ul class="space-y-2 relative">
            <li
                v-for="value in data"
                :key="value"
                class="relative w-full group"
            >
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div
                            :class="`absolute top-0 left-0 h-full dark:bg-opacity-20 rounded-sm ${colorClass}`"
                            :style="`max-width: 85%; width: ${helper.calcPercentage(
                                total,
                                value.y
                            )}%`"
                        ></div>
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
                                    'text-gray-800 dark:text-white text-sm font-medium': true,
                                    capitalize: capitalize,
                                    uppercase: uppercase,
                                }"
                            >
                                {{ value.x }}
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between min-w-[4rem]">
                        <div
                            class="invisible group-hover:visible flex text-xs font-medium text-gray-500 dark:hover:text-gray-300"
                        >
                            {{ helper.calcPercentage(total, value.y) }}%
                        </div>
                        <div
                            class="text-sm font-medium text-gray-800 dark:text-white"
                        >
                            {{ helper.kFormatter(value.y) }}
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>
