<script setup>
import { ref, computed } from "vue";
import Tab from "@/Components/Tab.vue";
import Page from "@/Pages/App/Website/Show/Page/Page.vue";
import EntryPage from "@/Pages/App/Website/Show/Page/EntryPage.vue";
import ExitPage from "@/Pages/App/Website/Show/Page/ExitPage.vue";

const { dateRange, website } = defineProps({
    dateRange: Object,
    website: Object,
});

const tabs = ["Pages", "Entry Pages", "Exit Pages"];
const tab = ref(tabs[0]);

const setTab = (value) => {
    tab.value = value;
};
</script>

<template>
    <div class="col-span-12 lg:col-span-6 card p-4 min-h-[450px]">
        <Tab :currentTab="tab" :tabs="tabs" @update="setTab" :title="tab" />
        <div class="mt-4">
            <Page
                :dateRange="dateRange"
                v-if="tab == 'Pages'"
                key="pages"
                :website="website"
            />
            <EntryPage
                :dateRange="dateRange"
                v-else-if="tab == 'Entry Pages'"
                key="entryPages"
                :website="website"
            />
            <ExitPage
                :dateRange="dateRange"
                v-else-if="tab == 'Exit Pages'"
                key="exitPages"
                :website="website"
            />
        </div>
    </div>
</template>
