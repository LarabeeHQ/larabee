<script setup>
import Table from "@/Components/Table.vue";
import { ref, onMounted, watch } from "vue";

const { dateRange } = defineProps({
    dateRange: Object,
});

const terms = ref(null);

const loadData = () => {
    axios
        .get(route("dashboard.utm-terms"), {
            params: {
                start: dateRange.start,
                end: dateRange.end,
            },
        })
        .then((response) => {
            terms.value = response.data;
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
    <Table v-if="terms" :data="terms" progressBarColor="green" />
</template>
