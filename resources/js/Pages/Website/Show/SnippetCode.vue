<script setup>
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";
import { Square2StackIcon } from "@heroicons/vue/24/outline";

const { website } = defineProps({
    website: Object,
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
    <div class="relative">
        <pre
            class="mt-4 transition focus:outline-none focus:border-transparent focus:ring-0 overflow-hidden bg-gray-100 dark:bg-zinc-900 dark:hover:bg-zinc-500/20 border border-transparent rounded-md w-full resize-none"
            ref="snippet"
            @click="copySnippet"
            readonly="readonly"
            rows="2"
        ><code>
&lt;script defer src="https://tracker.wanalytics.io/l.js"&gt;&lt;/script&gt;
</code>
</pre>
        <div class="absolute top-6 right-6">
            <Square2StackIcon class="h-4 w-4 absolute text-white" />
        </div>
    </div>
</template>
