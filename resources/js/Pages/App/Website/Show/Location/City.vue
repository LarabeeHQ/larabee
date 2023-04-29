<script setup>
import Table from "@/Components/Table.vue";
import { ref, onMounted, watch } from "vue";

const { dateRange, website } = defineProps({
    dateRange: Object,
    website: Object,
});

const cities = ref(null);

const loadData = async () => {
    return await axios
        .get(route("analytics.statistics"), {
            params: {
                ...dateRange,
                metric: "cities",
            },
        })
        .then((response) => {
            cities.value = response.data;
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
    <Table v-if="cities" :data="cities" />
</template>
