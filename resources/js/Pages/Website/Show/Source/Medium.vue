<script setup>
import Table from "@/Components/Table.vue";
import { ref, onMounted, watch } from "vue";

const { dateRange, website } = defineProps({
    dateRange: Object,
    website: Object,
});

const mediums = ref(null);

const loadData = async () => {
    return await axios
        .get(route("websites.statistics", website.id), {
            params: {
                start: dateRange.start,
                end: dateRange.end,
                metric: "utm-mediums",
            },
        })
        .then((response) => {
            mediums.value = response.data;
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
    <Table v-if="mediums" :data="mediums" progressBarColor="green" />
</template>
