<script setup>
import Table from "@/Components/Table.vue";
import { ref, onMounted, watch } from "vue";

const { dateRange, website } = defineProps({
    dateRange: Object,
    website: Object,
});

const browsers = ref(null);

const loadData = () => {
    axios
        .get(route("analytics.statistics"), {
            params: {
                ...dateRange,
                metric: "browsers",
            },
        })
        .then((response) => {
            browsers.value = response.data;
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
    <Table v-if="browsers" :data="browsers" />
</template>
