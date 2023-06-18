<script setup>
import { computed, useSlots } from "vue";
import SectionTitle from "./SectionTitle.vue";

defineEmits(["submitted"]);

const hasActions = computed(() => !!useSlots().actions);
</script>

<template>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <SectionTitle>
            <template #title>
                <slot name="title" />
            </template>
            <template #description>
                <slot name="description" />
            </template>
        </SectionTitle>

        <div class="mt-5 md:mt-0 md:col-span-2">
            <form @submit.prevent="$emit('submitted')">
                <div
                    class="px-4 py-5 border-x-2 border-t-2 border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 sm:p-6"
                    :class="
                        hasActions
                            ? 'rounded-tl-md rounded-tr-md'
                            : 'rounded-md'
                    "
                >
                    <div class="grid grid-cols-6 gap-6">
                        <slot name="form" />
                    </div>
                </div>

                <div
                    v-if="hasActions"
                    class="flex items-center justify-end border-2 border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 px-4 py-3 text-right sm:px-6 rounded-bl-md rounded-br-md"
                >
                    <slot name="actions" />
                </div>
            </form>
        </div>
    </div>
</template>
