<script setup>
import Header from "./Header.vue";
import Footer from "./Footer.vue";
</script>

<template>
    <div class="bg-white">
        <Header />
        <slot />
        <Footer />
    </div>
</template>
