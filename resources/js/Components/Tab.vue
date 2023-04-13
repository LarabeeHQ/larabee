<script setup>
import { ref } from "vue";

const emit = defineEmits(["update"]);

const { tabs } = defineProps({
    tabs: Array,
    title: String,
    currentTab: String,
});

const setCurrentTab = (tab) => {
    emit("update", tab);
};
</script>

<template>
    <div class="flex items-center justify-between">
        <div class="capitalize font-bold">{{ title }}</div>

        <div class="flex items-center space-x-1.5 xl:space-x-3">
            <div
                v-for="tab in tabs"
                :key="tab"
                @click="setCurrentTab(tab)"
                :class="{
                    'cursor-pointer capitalize text-xs xl:text-base font-semibold border-b-2': true,
                    'text-black dark:text-white border-black dark:border-white':
                        currentTab == tab,
                    'text-gray-600 dark:text-gray-400 border-transparent':
                        currentTab != tab,
                }"
            >
                {{ tab }}
            </div>

            <slot name="right" />
        </div>
    </div>
</template>
