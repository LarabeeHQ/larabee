<script setup>
import Table from "@/Components/Table.vue";
import { ref, onMounted, watch } from "vue";

const { dateRange } = defineProps({
    dateRange: Object,
});

const devices = ref(null);

const loadData = () => {
    axios
        .get(route("dashboard.devices"), {
            params: {
                start: dateRange.start,
                end: dateRange.end,
            },
        })
        .then((response) => {
            devices.value = response.data;
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
    <Table
        v-if="devices"
        :data="devices"
        progressBarColor="pink"
        :capitalize="true"
    />
</template>
