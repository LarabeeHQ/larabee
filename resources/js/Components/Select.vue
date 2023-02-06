<template>
    <select
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
        class="text-gray-800 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 border-transparent dark:placeholder:text-gray-600 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm"
    >
        <option :value="null">Select...</option>
        <option v-for="(value, index) in values" :key="index" :value="index">
            {{ value }}
        </option>
    </select>
</template>

<script>
export default {
    props: ["values", "modelValue"],

    emits: ["update:modelValue"],

    methods: {
        focus() {
            this.$refs.input.focus();
        },
    },
};
</script>
