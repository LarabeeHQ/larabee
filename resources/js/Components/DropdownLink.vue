<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <Link
        class="block w-full px-4 py-2 text-left text-sm leading-5 focus:outline-none transition duration-150 ease-in-out bg-white dark:bg-zinc-800 text-gray-700 dark:text-white cursor-pointer hover:bg-gray-100 dark:hover:bg-zinc-700"
    >
        <slot />
    </Link>
</template>
