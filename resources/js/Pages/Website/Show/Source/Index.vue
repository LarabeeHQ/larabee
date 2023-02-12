<script setup>
import { ref } from "vue";
import Tab from "@/Components/Tab.vue";
import ReferrerTable from "@/Pages/Website/Show/Source/Referrer.vue";
import MediumTable from "@/Pages/Website/Show/Source/Medium.vue";
import SourceTable from "@/Pages/Website/Show/Source/Source.vue";
import CampaignTable from "@/Pages/Website/Show/Source/Campaign.vue";
import ContentTable from "@/Pages/Website/Show/Source/Content.vue";
import TermTable from "@/Pages/Website/Show/Source/Term.vue";

const { dateRange, website } = defineProps({
    dateRange: Object,
    website: Object,
});

const tabs = ["referrers", "medium", "source", "campaign", "content", "term"];
const tab = ref(tabs[0]);

const setTab = (value) => {
    tab.value = value;
};
</script>

<template>
    <div class="col-span-12 lg:col-span-6 card p-4 min-h-[450px]">
        <Tab :tabs="tabs" @update="setTab" />

        <div class="mt-4">
            <ReferrerTable
                v-if="tab == 'referrers'"
                key="referrers"
                :dateRange="dateRange"
                :website="website"
            />
            <MediumTable
                if="tab == 'medium'"
                key="medium"
                :dateRange="dateRange"
                :website="website"
            />
            <SourceTable
                v-if="tab == 'source'"
                key="source"
                :dateRange="dateRange"
                :website="website"
            />
            <!-- <Campaign
                if="tab == 'campaign'"
                key="campaign"
                :dateRange="dateRange"
                :website="website"
            />
            <Content
                if="tab == 'content'"
                key="content"
                :dateRange="dateRange"
                :website="website"
            />
            <Term
                v-else-if="tab == 'term'"
                key="term"
                :dateRange="dateRange"
                :website="website"
            /> -->
        </div>
    </div>
</template>
