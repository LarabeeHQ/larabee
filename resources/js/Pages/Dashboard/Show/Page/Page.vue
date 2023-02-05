<script setup>
import { ref, onMounted, watch } from "vue";

const { dateRange } = defineProps({
    dateRange: Object,
});

const tabs = ["pages", "entryPages", "exitPages"];
const currentTab = ref("pages");
const pages = ref([]);

const loadData = async () => {
    return await axios
        .get(route("dashboard.pages"), {
            params: {
                start: dateRange.start,
                end: dateRange.end,
            },
        })
        .then((response) => {
            pages.value = response.data;
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
    <div>
        <ul>
            <li v-for="page in pages" :key="page">
                <div class="flex items-center justify-between">
                    <div>{{ page.url }}</div>
                    <div>{{ page.total }}</div>
                </div>
            </li>
        </ul>
    </div>
</template>
