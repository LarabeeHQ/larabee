<script setup>
import Modal from "./Modal.vue";

const emit = defineEmits(["close"]);

defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: "2xl",
    },
    closeable: {
        type: Boolean,
        default: true,
    },
});

const close = () => {
    emit("close");
};
</script>

<template>
    <Modal
        :show="show"
        :max-width="maxWidth"
        :closeable="closeable"
        @close="close"
    >
        <div class="px-4 py-4 border-b border-gray-100 dark:border-zinc-700">
            <div class="text-lg font-bold">
                <slot name="title" />
            </div>
        </div>

        <div class="px-4 py-4">
            <slot name="content" />
        </div>

        <div
            class="flex flex-row justify-end px-6 py-4 bg-gray-100 dark:bg-zinc-800 text-right rounded-b-lg"
        >
            <slot name="footer" />
        </div>
    </Modal>
</template>
