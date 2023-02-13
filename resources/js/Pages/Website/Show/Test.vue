<script setup>
import { ref, onMounted } from "vue";

const { dateRange, website } = defineProps({
    dateRange: Object,
    website: Object,
});

onMounted(() => {
    console.log(dateRange);
    console.log(website);
});
</script>
<template>
    <div class="text-white">asa</div>
</template>
