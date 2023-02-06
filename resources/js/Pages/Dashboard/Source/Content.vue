<script setup>
import Table from "@/Components/Table.vue";
import { ref, onMounted, watch } from "vue";

const { dateRange } = defineProps({
    dateRange: Object,
});

const contents = ref(null);

const loadData = () => {
    axios
        .get(route("dashboard.utm-contents"), {
            params: {
                start: dateRange.start,
                end: dateRange.end,
            },
        })
        .then((response) => {
            contents.value = response.data;
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
    <Table v-if="contents" :data="contents" progressBarColor="green" />
</template>
