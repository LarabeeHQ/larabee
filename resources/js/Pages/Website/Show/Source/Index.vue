<script setup>
import { ref } from "vue";
import Tab from "@/Components/Tab.vue";
import Referrer from "@/Pages/Website/Show/Source/Referrer.vue";
import Medium from "@/Pages/Website/Show/Source/Medium.vue";
import Source from "@/Pages/Website/Show/Source/Source.vue";
import Campaign from "@/Pages/Website/Show/Source/Campaign.vue";
import Content from "@/Pages/Website/Show/Source/Content.vue";
import Term from "@/Pages/Website/Show/Source/Term.vue";

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
    <div class="col-span-6 card p-4 min-h-[450px]">
        <Tab :tabs="tabs" @update="setTab" />

        <div class="mt-4">
            <Referrer
                v-if="tab == 'referrers'"
                :dateRange="dateRange"
                :website="website"
            />
            <Medium
                v-else-if="tab == 'medium'"
                :dateRange="dateRange"
                :website="website"
            />
            <Source
                v-else-if="tab == 'source'"
                :dateRange="dateRange"
                :website="website"
            />
            <Campaign
                v-else-if="tab == 'campaign'"
                :dateRange="dateRange"
                :website="website"
            />
            <Content
                v-else-if="tab == 'content'"
                :dateRange="dateRange"
                :website="website"
            />
            <Term
                v-else-if="tab == 'term'"
                :dateRange="dateRange"
                :website="website"
            />
        </div>
    </div>
</template>
