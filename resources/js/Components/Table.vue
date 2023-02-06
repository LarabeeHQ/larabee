<script setup>
import helper from "@/helper";
import { onBeforeMount, onMounted, ref, watch } from "vue";

const total = ref(0);

const { data } = defineProps({
    data: Object,
    favicon: {
        type: Boolean,
        default: false,
    },
    country: {
        type: Boolean,
        default: false,
    },
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
                            class="absolute top-0 left-0 h-full bg-gray-100 dark:bg-gray-500 dark:bg-opacity-15"
                            :style="`width: ${helper.calcPercentage(
                                total,
                                value.y
                            )}%`"
                        ></div>
                        <div
                            class="flex items-center space-x-1 z-10 px-2 py-0.5"
                        >
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

                            <div>{{ value.x }}</div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="mr-4 hidden group-hover:flex">
                            {{ helper.calcPercentage(total, value.y) }}%
                        </div>
                        <div>{{ helper.kFormatter(value.y) }}</div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>
