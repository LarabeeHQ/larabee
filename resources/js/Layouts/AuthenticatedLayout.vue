<script setup>
import { usePage } from "@inertiajs/vue3";
import { onMounted, ref, watch, computed } from "vue";

import Sidebar from "./Sidebar.vue";
import Banner from "@/Components/Banner.vue";

const user = computed(() => usePage().props.auth.user);
const darkMode = ref(localStorage.getItem("theme") == "dark" ? true : false);

onMounted(() => {
    // guest
    if (!user.value) {
        if (
            window.matchMedia &&
            window.matchMedia("(prefers-color-scheme: dark)").matches
        ) {
            document.documentElement.classList.add("dark");
        }

        return;
    }

    // authenticated user
    setTheme(user.value.theme);

    if (user.value.theme == "system") {
        // listen for system theme changes
        window
            .matchMedia("(prefers-color-scheme: dark)")
            .addEventListener("change", (event) => {
                if (event.matches) {
                    document.documentElement.classList.add("dark");
                } else {
                    document.documentElement.classList.remove("dark");
                }
            });
    }
});

const setTheme = (theme) => {
    if (theme == "dark") {
        document.documentElement.classList.add("dark");
    } else if (theme == "light") {
        document.documentElement.classList.remove("dark");
    } else if (theme == "system") {
        if (
            window.matchMedia &&
            window.matchMedia("(prefers-color-scheme: dark)").matches
        ) {
            document.documentElement.classList.add("dark");
        } else {
            document.documentElement.classList.remove("dark");
        }
    }
};

watch(user, () => {
    if (user.value.theme == "dark") {
        setTheme("dark");
    } else if (user.value.theme == "light") {
        setTheme("light");
    } else if (user.value.theme == "system") {
        setTheme("system");
    }
});
</script>

<template>
    <Sidebar v-if="user" />
    <Banner />

    <main :class="{ 'py-4 xl:py-8': true, 'lg:pl-72': user }">
        <div class="px-4 xl:px-8">
            <slot />
        </div>
    </main>
</template>
