<script setup>
import { ref, onMounted, watch } from "vue";
import Tab from "@/Components/Tab.vue";
import Page from "@/Pages/Website/Show/Page/Page.vue";
import EntryPage from "@/Pages/Website/Show/Page/EntryPage.vue";
import ExitPage from "@/Pages/Website/Show/Page/ExitPage.vue";

const { dateRange, website } = defineProps({
    dateRange: Object,
    website: Object,
});

const tabs = ["pages", "entryPages", "exitPages"];
const tab = ref(tabs[0]);

const setTab = (value) => {
    tab.value = value;
};
</script>

<template>
    <div class="col-span-12 lg:col-span-6 card p-4 min-h-[450px]">
        <Tab :tabs="tabs" @update="setTab" />
        <div class="mt-4">
            <Page
                :dateRange="dateRange"
                v-if="tab == 'pages'"
                key="pages"
                :website="website"
            />
            <EntryPage
                :dateRange="dateRange"
                v-else-if="tab == 'entryPages'"
                key="entryPages"
                :website="website"
            />
            <ExitPage
                :dateRange="dateRange"
                v-else-if="tab == 'exitPages'"
                key="exitPages"
                :website="website"
            />
        </div>
    </div>
</template>
