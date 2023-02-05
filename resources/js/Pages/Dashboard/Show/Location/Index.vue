<script setup>
import { ref, onMounted } from "vue";
import City from "./City.vue";
import Country from "./Country.vue";
import Region from "./Region.vue";

const { dateRange } = defineProps({
    dateRange: Object,
});

const currentTab = ref("countries");
</script>

<template>
    <div class="col-span-6 bg-white dark:bg-gray-900 rounded-md p-4">
        <div class="flex items-center space-x-1">
            <div
                @click="currentTab = 'countries'"
                :class="{
                    'cursor-pointer text-sm': true,
                    'font-semibold': currentTab == 'countries',
                }"
            >
                Countries
            </div>

            <div
                @click="currentTab = 'regions'"
                :class="{
                    'cursor-pointer text-sm': true,
                    'font-semibold': currentTab == 'regions',
                }"
            >
                Regions
            </div>

            <div
                @click="currentTab = 'cities'"
                :class="{
                    'cursor-pointer text-sm': true,
                    'font-semibold': currentTab == 'cities',
                }"
            >
                Cities
            </div>
        </div>

        <Country v-if="currentTab == 'countries'" :dateRange="dateRange" />
        <Region v-else-if="currentTab == 'regions'" :dateRange="dateRange" />
        <City v-else-if="currentTab == 'cities'" :dateRange="dateRange" />
    </div>
</template>
