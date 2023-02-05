<script setup>
import { ref, onMounted, watch } from "vue";

const { dateRange } = defineProps({
    dateRange: Object,
});

const contents = ref([]);

const loadData = async () => {
    return await axios
        .get(route("dashboard.utm-contents"), {
            params: {
                start: dateRange.start,
                end: dateRange.end,
            },
        })
        .then((response) => {
            contents.value = response.data;
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
            <li v-for="data in contents" :key="data">
                <div class="flex items-center justify-between">
                    <div class="capitalize">
                        {{ data.x }}
                    </div>
                    <div>{{ data.y }}</div>
                </div>
            </li>
        </ul>
    </div>
</template>
