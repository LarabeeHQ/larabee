<script setup>
import Table from "@/Components/Table.vue";
import { ref, onMounted, watch } from "vue";

const { dateRange } = defineProps({
    dateRange: Object,
});

const referrers = ref(null);

const loadData = () => {
    axios
        .get(route("dashboard.referrers"), {
            params: {
                start: dateRange.start,
                end: dateRange.end,
            },
        })
        .then((response) => {
            referrers.value = response.data;
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
        v-if="referrers"
        :data="referrers"
        progressBarColor="green"
        :favicon="true"
    />
</template>
