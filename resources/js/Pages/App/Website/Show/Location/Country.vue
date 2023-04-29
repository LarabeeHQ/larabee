<script setup>
import Table from "@/Components/Table.vue";
import { ref, watch } from "vue";

const { dateRange, website } = defineProps({
    dateRange: Object,
    website: Object,
});

const countries = ref(null);

const loadData = () => {
    axios
        .get(route("analytics.statistics"), {
            params: {
                ...dateRange,
                metric: "countries",
            },
        })
        .then((response) => {
            countries.value = response.data;
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
    <Table v-if="countries" :data="countries" :country="true" />
</template>
