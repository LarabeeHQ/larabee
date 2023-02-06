<script setup>
import Table from "@/Components/Table.vue";
import { ref, onMounted, watch } from "vue";

const { dateRange } = defineProps({
    dateRange: Object,
});

const pages = ref(null);

const loadData = () => {
    axios
        .get(route("dashboard.pages"), {
            params: {
                start: dateRange.start,
                end: dateRange.end,
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
    <Table v-if="pages" :data="pages" progressBarColor="blue" />
</template>
