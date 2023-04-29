<script setup>
import Table from "@/Components/Table.vue";
import { ref, watch } from "vue";

const { dateRange, website } = defineProps({
    dateRange: Object,
    website: Object,
});

const languages = ref(null);

const loadData = () => {
    axios
        .get(route("analytics.statistics"), {
            params: {
                ...dateRange,
                metric: "languages",
            },
        })
        .then((response) => {
            languages.value = response.data;
        });
};

watch(
    dateRange,
    () => {
        loadData();
    },
    { immediate: true }
);
</script>
<template>
    <Table v-if="languages" :data="languages" :uppercase="true" />
</template>
