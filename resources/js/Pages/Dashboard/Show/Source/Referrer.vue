<script setup>
import { ref, onMounted, watch } from "vue";

const { dateRange } = defineProps({
    dateRange: Object,
});

const referrers = ref([]);

const loadData = async () => {
    return await axios
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
    <div>
        <ul>
            <li v-for="data in referrers" :key="data">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-1">
                        <img
                            :src="`https://www.google.com/s2/favicons?domain=${data.x}&sz=128`"
                            class="w-4 h-4"
                        />
                        <div>{{ data.x }}</div>
                    </div>
                    <div>{{ data.y }}</div>
                </div>
            </li>
        </ul>
    </div>
</template>
