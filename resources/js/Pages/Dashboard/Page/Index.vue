<script setup>
import { ref, onMounted, watch } from "vue";
import Tab from "@/Components/Tab.vue";
import Page from "./Page.vue";
import EntryPage from "./EntryPage.vue";
import ExitPage from "./ExitPage.vue";

const { dateRange } = defineProps({
    dateRange: Object,
});

const tabs = ["pages", "entryPages", "exitPages"];
const tab = ref("pages");

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
            <Page :dateRange="dateRange" v-if="tab == 'pages'" />
            <EntryPage :dateRange="dateRange" v-if="tab == 'entryPages'" />
            <ExitPage :dateRange="dateRange" v-if="tab == 'exitPages'" />
        </div>
    </div>
</template>
