<script setup>
import { ref } from "vue";
import Tab from "@/Components/Tab.vue";
import Browser from "./Browser.vue";
import OS from "./OS.vue";
import Language from "./Language.vue";
import Screen from "./Screen.vue";
import Device from "./Device.vue";

const tabs = ["devices", "browsers", "OS", "language", "screen"];
const tab = ref("devices");

const { dateRange } = defineProps({
    dateRange: Object,
});

const setTab = (value) => {
    tab.value = value;
};
</script>

<template>
    <div
        class="col-span-6 bg-white dark:bg-gray-900 rounded-lg shadow dark:shadow-none p-4 min-h-[426px]"
    >
        <Tab :tabs="tabs" @update="setTab" />

        <div class="mt-4">
            <Screen v-if="tab == 'screen'" :dateRange="dateRange" />
            <Device v-else-if="tab == 'devices'" :dateRange="dateRange" />
            <Browser v-else-if="tab == 'browsers'" :dateRange="dateRange" />
            <OS v-else-if="tab == 'OS'" :dateRange="dateRange" />
            <Language v-else-if="tab == 'language'" :dateRange="dateRange" />
        </div>
    </div>
</template>
