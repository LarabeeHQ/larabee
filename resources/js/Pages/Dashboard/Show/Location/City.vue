<script setup>
import { ref, onMounted, watch } from "vue";

const { dateRange } = defineProps({
    dateRange: Object,
});

const cities = ref([]);

const loadData = async () => {
    return await axios
        .get(route("dashboard.cities"), {
            params: {
                start: dateRange.start,
                end: dateRange.end,
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
    <div class="mt-4">
        <div class="flex items-center justify-between">
            <div>Country</div>
            <div>Visitors</div>
        </div>
        <ul>
            <li v-for="data in cities" :key="data">
                <div class="flex items-center justify-between">
                    <div>
                        <div>{{ data.x }}</div>
                    </div>
                    <div>{{ data.y }}</div>
                </div>
            </li>
        </ul>
    </div>
</template>
