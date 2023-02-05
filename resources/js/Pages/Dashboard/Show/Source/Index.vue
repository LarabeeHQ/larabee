<script setup>
import { ref, onMounted } from "vue";
import Referrer from "./Referrer.vue";
import Medium from "./Medium.vue";
import Source from "./Source.vue";
import Campaign from "./Campaign.vue";
import Content from "./Content.vue";
import Term from "./Term.vue";

const { dateRange } = defineProps({
    dateRange: Object,
});

const currentTab = ref("referrers");

const tabs = ["referrers", "medium", "source", "campaign", "content", "term"];
</script>

<template>
    <div class="col-span-6 bg-white dark:bg-gray-900 rounded-md p-4">
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

        <div>
            <Referrer v-if="currentTab == 'referrers'" :dateRange="dateRange" />
            <Medium v-else-if="currentTab == 'medium'" :dateRange="dateRange" />
            <Source v-else-if="currentTab == 'source'" :dateRange="dateRange" />
            <Campaign
                v-else-if="currentTab == 'campaign'"
                :dateRange="dateRange"
            />
            <Content
                v-else-if="currentTab == 'content'"
                :dateRange="dateRange"
            />
            <Term v-else-if="currentTab == 'term'" :dateRange="dateRange" />
        </div>
    </div>
</template>
