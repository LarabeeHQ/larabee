<script setup>
import Table from "@/Components/Table.vue";
import { ref, watch } from "vue";

const { dateRange, website } = defineProps({
    dateRange: Object,
    website: Object,
});

const regions = ref(null);

const loadData = () => {
    axios
        .get(route("analytics.statistics"), {
            params: {
                ...dateRange,
                metric: "regions",
            },
        })
        .then((response) => {
            regions.value = response.data;
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
    <Table v-if="regions" :data="regions" />
</template>
