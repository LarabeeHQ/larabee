<script setup>
import Table from "@/Components/Table.vue";
import { ref, watch } from "vue";

const { dateRange, website } = defineProps({
    dateRange: Object,
    website: Object,
});

const pages = ref(null);

const loadData = () => {
    axios
        .get(route("analytics.statistics"), {
            params: {
                ...dateRange,
                metric: "pages",
            },
        })
        .then((response) => {
            pages.value = response.data;
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
    <Table v-if="pages" :data="pages" />
</template>
