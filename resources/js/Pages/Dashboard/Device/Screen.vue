<script setup>
import Table from "@/Components/Table.vue";
import { ref, onMounted, watch } from "vue";

const { dateRange } = defineProps({
    dateRange: Object,
});

const screens = ref(null);

const loadData = () => {
    axios
        .get(route("dashboard.screens"), {
            params: {
                start: dateRange.start,
                end: dateRange.end,
            },
        })
        .then((response) => {
            screens.value = response.data;
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
    <Table v-if="screens" :data="screens" progressBarColor="pink" />
</template>
