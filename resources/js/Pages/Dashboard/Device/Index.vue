<script setup>
import { ref } from "vue";
import Browser from "./Browser.vue";
import OS from "./OS.vue";
import Language from "./Language.vue";
import Screen from "./Screen.vue";
import Device from "./Device.vue";

const tabs = ["devices", "browsers", "OS", "language", "screen"];
const currentTab = ref("devices");

const { dateRange } = defineProps({
    dateRange: Object,
});
</script>

<template>
    <div
        class="col-span-4 bg-white dark:bg-gray-900 rounded-md p-4 min-h-[20rem]"
    >
        <div class="flex items-center">
            <div class="flex items-center space-x-1">
                <div
                    v-for="tab in tabs"
                    :key="tab"
                    @click="currentTab = tab"
                    :class="{
                        'font-medium cursor-pointer text-sm px-1 py-1 rounded-md text-gray-300 capitalize': true,
                        'font-semibold text-black dark:text-white':
                            currentTab == tab,
                    }"
                >
                    {{ tab }}
                </div>
            </div>
        </div>

        <div class="mt-4">
            <Screen v-if="currentTab == 'screen'" :dateRange="dateRange" />
            <Device
                v-else-if="currentTab == 'devices'"
                :dateRange="dateRange"
            />
            <Browser
                v-else-if="currentTab == 'browsers'"
                :dateRange="dateRange"
            />
            <OS v-else-if="currentTab == 'OS'" :dateRange="dateRange" />
            <Language
                v-else-if="currentTab == 'language'"
                :dateRange="dateRange"
            />
        </div>
    </div>
</template>
