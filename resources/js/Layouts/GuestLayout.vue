<script setup>
import { onMounted, ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";

if (
    window.matchMedia &&
    window.matchMedia("(prefers-color-scheme: dark)").matches
) {
    document.documentElement.classList.add("dark");
}
</script>

<template>
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-zinc-100 dark:bg-zinc-900"
    >
        <div>
            <Link href="/">
                <ApplicationLogo class="h-20 fill-current text-gray-500" />
            </Link>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 card overflow-hidden sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>
