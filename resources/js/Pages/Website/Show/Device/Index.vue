<script setup>
import { ref } from "vue";
import Tab from "@/Components/Tab.vue";
import Browser from "@/Pages/Website/Show/Device/Browser.vue";
import OS from "@/Pages/Website/Show/Device/OS.vue";
import Language from "@/Pages/Website/Show/Device/Language.vue";
import Screen from "@/Pages/Website/Show/Device/Screen.vue";
import Device from "@/Pages/Website/Show/Device/Device.vue";

const tabs = ["devices", "browsers", "OS", "language", "screen"];
const tab = ref("devices");

const { dateRange, website } = defineProps({
    dateRange: Object,
    website: Object,
});

const setTab = (value) => {
    tab.value = value;
};
</script>

<template>
    <div class="col-span-6 card p-4 min-h-[426px]">
        <Tab :tabs="tabs" @update="setTab" />

        <div class="mt-4">
            <Screen
                v-if="tab == 'screen'"
                :dateRange="dateRange"
                :website="website"
            />
            <Device
                v-else-if="tab == 'devices'"
                :dateRange="dateRange"
                :website="website"
            />
            <Browser
                v-else-if="tab == 'browsers'"
                :dateRange="dateRange"
                :website="website"
            />
            <OS
                v-else-if="tab == 'OS'"
                :dateRange="dateRange"
                :website="website"
            />
            <Language
                v-else-if="tab == 'language'"
                :dateRange="dateRange"
                :website="website"
            />
        </div>
    </div>
</template>
