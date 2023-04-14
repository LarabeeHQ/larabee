<script setup>
import { ref } from "vue";
import Tab from "@/Components/Tab.vue";
import Browser from "@/Pages/App/Website/Show/Device/Browser.vue";
import OS from "@/Pages/App/Website/Show/Device/OS.vue";
import Language from "@/Pages/App/Website/Show/Device/Language.vue";
import Device from "@/Pages/App/Website/Show/Device/Device.vue";

const tabs = ["devices", "browsers", "OS", "language"];
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
    <div class="col-span-12 lg:col-span-6 card p-4 min-h-[450px]">
        <Tab :currentTab="tab" :tabs="tabs" @update="setTab" :title="tab" />

        <div class="mt-4">
            <Device
                v-if="tab == 'devices'"
                key="devices"
                :dateRange="dateRange"
                :website="website"
            />
            <Browser
                v-else-if="tab == 'browsers'"
                key="browsers"
                :dateRange="dateRange"
                :website="website"
            />
            <OS
                v-else-if="tab == 'OS'"
                key="OS"
                :dateRange="dateRange"
                :website="website"
            />
            <Language
                v-else-if="tab == 'language'"
                key="language"
                :dateRange="dateRange"
                :website="website"
            />
        </div>
    </div>
</template>
