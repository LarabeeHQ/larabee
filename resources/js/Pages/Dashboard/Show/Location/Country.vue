<script setup>
import { ref, onMounted, watch } from "vue";

const { dateRange } = defineProps({
    dateRange: Object,
});

const countries = ref([]);

const loadData = async () => {
    return await axios
        .get(route("dashboard.countries"), {
            params: {
                start: dateRange.start,
                end: dateRange.end,
            },
        })
        .then((response) => {
            countries.value = response.data;
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
            <li v-for="data in countries" :key="data">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-1">
                        <img
                            :src="`https://flagcdn.com/16x12/${data.x.toLowerCase()}.png`"
                            :alt="data.x"
                        />
                        <div>{{ data.x }}</div>
                    </div>
                    <div>{{ data.y }}</div>
                </div>
            </li>
        </ul>
    </div>
</template>
