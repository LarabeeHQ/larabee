<script setup>
import { computed, useSlots } from "vue";
import SectionTitle from "./SectionTitle.vue";

defineEmits(["submitted"]);

const hasActions = computed(() => !!useSlots().actions);
</script>

<template>
    <div
        class="px-4 py-4 sm:px-6 sm:py-6 bg-white border border-gray-200 rounded-lg"
    >
        <SectionTitle>
            <template #title>
                <div class="flex items-center">
                    <slot name="title"></slot>
                </div>
            </template>
            <template #description>
                <slot name="description"></slot>
            </template>
        </SectionTitle>

        <form @submit.prevent="$emit('submitted')">
            <div class="pt-4">
                <div class="grid grid-cols-6 gap-6">
                    <slot name="form"></slot>
                </div>
            </div>

            <div class="flex items-center justify-start pt-4" v-if="hasActions">
                <slot name="actions"></slot>
            </div>
        </form>
    </div>
</template>
