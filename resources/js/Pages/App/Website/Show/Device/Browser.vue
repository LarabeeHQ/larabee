<script setup>
import browserHelper from "@/browserHelper";
import Table from "@/Components/Table.vue";
import { ref, watch } from "vue";

const { dateRange, website } = defineProps({
    dateRange: Object,
    website: Object,
});

const browsers = ref(null);

const loadData = () => {
    axios
        .get(route("analytics.statistics"), {
            params: {
                ...dateRange,
                metric: "browsers",
            },
        })
        .then((response) => {
            browsers.value = response.data.map((item) => {
                return {
                    ...item,
                    browser: browserHelper.getBrowserName(item.x),
                };
            });
        });
};

watch(
    dateRange,
    () => {
        loadData();
    },
    { immediate: true }
);
</script>
<template>
    <Table v-if="browsers" :data="browsers" />
</template>
