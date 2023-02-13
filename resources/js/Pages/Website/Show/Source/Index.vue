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

const tabNames = [
    "Referrer",
    "Medium",
    "Source",
    "Campaign",
    "Content",
    "Term",
];
const tabs = { Referrer, Medium, Source, Campaign, Content, Term };
const tab = ref("Referrer");

const setTab = (value) => {
    tab.value = value;
};
</script>

<template>
    <div class="col-span-12 lg:col-span-6 card p-4 min-h-[450px]">
        <!-- <Tab :tabs="tabNames" @update="setTab" /> -->
        <div class="mt-4">
            <component
                :is="tabs[tab]"
                :dateRange="dateRange"
                :website="website"
            />
        </div>
    </div>
</template>
