<script setup>
import Table from "@/Components/Table.vue";
import { ref, onMounted, watch } from "vue";

const { dateRange, website } = defineProps({
    dateRange: Object,
    website: Object,
});

const screens = ref(null);

const loadData = () => {
    axios
        .get(route("websites.statistics", website.id), {
            params: {
                start: dateRange.date.start,
                end: dateRange.date.end,
                start_previous: dateRange.date.start_previous,
                end_previous: dateRange.date.end_previous,
                metric: "screens",
                group: dateRange.group,
                key: dateRange.key,
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
    <Table v-if="screens" :data="screens" />
</template>
