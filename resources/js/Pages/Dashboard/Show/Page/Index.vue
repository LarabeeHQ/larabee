<script setup>
import { ref, onMounted, watch } from "vue";
import Page from "./Page.vue";
import EntryPage from "./EntryPage.vue";
import ExitPage from "./ExitPage.vue";

const { dateRange } = defineProps({
    dateRange: Object,
});

const tabs = ["pages", "entryPages", "exitPages"];
const currentTab = ref("pages");
</script>

<template>
    <div class="col-span-4 bg-white dark:bg-gray-900 rounded-md p-4">
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
        <Page :dateRange="dateRange" v-if="currentTab == 'pages'" />
        <EntryPage :dateRange="dateRange" v-if="currentTab == 'entryPages'" />
        <ExitPage :dateRange="dateRange" v-if="currentTab == 'exitPages'" />
    </div>
</template>
