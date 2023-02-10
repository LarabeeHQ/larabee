<script setup>
import { ref, onMounted } from "vue";
import Tab from "@/Components/Tab.vue";
import Referrer from "./Referrer.vue";
import Medium from "./Medium.vue";
import Source from "./Source.vue";
import Campaign from "./Campaign.vue";
import Content from "./Content.vue";
import Term from "./Term.vue";

const { dateRange } = defineProps({
    dateRange: Object,
});

const tab = ref("referrers");
const tabs = ["referrers", "medium", "source", "campaign", "content", "term"];

const setTab = (value) => {
    tab.value = value;
};
</script>

<template>
    <div
        class="col-span-6 bg-white dark:bg-zinc-800 rounded-lg shadow dark:shadow-none p-4 min-h-[426px]"
    >
        <Tab :tabs="tabs" @update="setTab" />

        <div class="mt-4">
            <Referrer v-if="tab == 'referrers'" :dateRange="dateRange" />
            <Medium v-else-if="tab == 'medium'" :dateRange="dateRange" />
            <Source v-else-if="tab == 'source'" :dateRange="dateRange" />
            <Campaign v-else-if="tab == 'campaign'" :dateRange="dateRange" />
            <Content v-else-if="tab == 'content'" :dateRange="dateRange" />
            <Term v-else-if="tab == 'term'" :dateRange="dateRange" />
        </div>
    </div>
</template>
