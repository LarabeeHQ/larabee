<script setup>
import { ref, onMounted } from "vue";
import Tab from "@/Components/Tab.vue";
import City from "./City.vue";
import Country from "./Country.vue";
import Region from "./Region.vue";

const { dateRange } = defineProps({
    dateRange: Object,
});

const tab = ref("countries");
const tabs = ["countries", "regions", "cities"];

const setTab = (value) => {
    tab.value = value;
};
</script>

<template>
    <div
        class="col-span-6 bg-white dark:bg-zinc-900 rounded-lg shadow dark:shadow-none p-4 min-h-[426px]"
    >
        <div class="flex items-center space-x-1">
            <Tab :tabs="tabs" @update="setTab" />
        </div>
        <div class="mt-4">
            <Country v-if="tab == 'countries'" :dateRange="dateRange" />
            <Region v-else-if="tab == 'regions'" :dateRange="dateRange" />
            <City v-else-if="tab == 'cities'" :dateRange="dateRange" />
        </div>
    </div>
</template>
