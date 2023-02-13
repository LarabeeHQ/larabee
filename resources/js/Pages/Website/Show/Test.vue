<script setup>
import { ref, onMounted, watch } from "vue";

const { dateRange, website } = defineProps({
    dateRange: Object,
    website: Object,
});

const data = ref(null);

const loadData = () => {
    axios
        .get(route("websites.statistics", website.id), {
            params: {
                start: dateRange.start,
                end: dateRange.end,
                metric: "utm-sources",
            },
        })
        .then((response) => {
            data.value = response.data;
            console.log(data.value);
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
    <div class="text-white">asa</div>
</template>
