<script setup>
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";
import { Square2StackIcon } from "@heroicons/vue/24/outline";

const { website } = defineProps({
    website: Object,
    showDescription: {
        type: Boolean,
        default: true,
    },
});

const snippet = ref(null);

const copySnippet = () => {
    const copyText = snippet.value.value;
    const textArea = document.createElement("textarea");
    textArea.textContent = copyText;
    document.body.append(textArea);
    textArea.select();
    document.execCommand("copy");

    usePage().props.flash.bannerStyle = "success";
    usePage().props.flash.banner =
        "The javascript code was been copy to the clipboard.";
};
</script>
<template>
    <div class="card p-6">
        <div class="text-gray-800 dark:text-white">
            <div v-if="showDescription">
                <div class="text-xl font-semibold mb-1">
                    Your javascript code
                </div>
                <div class="text-base font-medium">
                    Paste this snippet in the head of your website.
                </div>
            </div>
            <div class="relative" @click="copySnippet">
                <textarea
                    class="cursor-pointer mt-4 transition focus:outline-none focus:border-transparent focus:ring-0 overflow-hidden bg-gray-100 dark:bg-zinc-900 dark:hover:bg-zinc-500/20 border border-transparent rounded-md w-full resize-none"
                    ref="snippet"
                    readonly="readonly"
                    rows="1"
                    >{{
                        `&lt;script defer website-id="${website.id}" src="https://cdn.wanalytics.io/l.js"&gt;&lt;/script&gt;`
                    }}</textarea
                >
                <div class="absolute top-6 right-6">
                    <Square2StackIcon class="h-4 w-4 absolute text-white" />
                </div>
            </div>
        </div>
    </div>
</template>
