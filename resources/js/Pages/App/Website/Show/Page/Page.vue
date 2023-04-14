<script setup>
import Table from "@/Components/Table.vue";
import { ref, onMounted, watch } from "vue";

const { dateRange, website } = defineProps({
    dateRange: Object,
    website: Object,
});

const pages = ref(null);

const loadData = () => {
    axios
        .get(route("analytics.statistics"), {
            params: {
                start: dateRange.date.start,
                end: dateRange.date.end,
                start_previous: dateRange.date.start_previous,
                end_previous: dateRange.date.end_previous,
                metric: "pages",
                group: dateRange.group,
                key: dateRange.key,
            },
        })
        .then((response) => {
            pages.value = response.data;
        });
};

onMounted(() => {
    loadData();
});

watch(dateRange, (value) => {
    loadData();
});
</script>

<template>
    <Table v-if="pages" :data="pages" />
</template>
