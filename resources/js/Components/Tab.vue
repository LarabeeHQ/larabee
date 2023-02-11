<script setup>
import { ref } from "vue";

const emit = defineEmits(["update"]);

const { tabs } = defineProps({
    tabs: Array,
});

const currentTab = ref(tabs[0]);

const setCurrentTab = (tab) => {
    currentTab.value = tab;
    emit("update", tab);
};
</script>

<template>
    <div class="flex items-center space-x-3">
        <div
            v-for="tab in tabs"
            :key="tab"
            @click="setCurrentTab(tab)"
            :class="{
                'cursor-pointer text-base  capitalize': true,
                'text-black dark:text-white font-bold border-b-2 border-black dark:border-white':
                    currentTab == tab,
                'text-gray-600 dark:text-gray-400 font-medium':
                    currentTab != tab,
            }"
        >
            {{ tab }}
        </div>
    </div>
</template>
