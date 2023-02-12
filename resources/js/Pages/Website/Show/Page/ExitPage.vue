<script setup>
import Table from "@/Components/Table.vue";
import { ref, onMounted, watch } from "vue";

const { dateRange, website } = defineProps({
    dateRange: Object,
    website: Object,
});

const data = ref(null);

const loadData = () => {
    axios
        .get(route("websites.statistics", website.id), {
            params: {
                start: dateRange.start,
                end: dateRange.end,
                metric: "exit-pages",
            },
        })
        .then((response) => {
            data.value = response.data;
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
    <Table v-if="data" :data="data" />
</template>
