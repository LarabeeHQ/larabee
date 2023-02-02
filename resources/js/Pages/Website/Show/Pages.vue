<template>
    <div class="col-span-4 bg-white p-4">
        <div class="flex items-center justify-between">
            <div>Pages</div>
            <div>Visitors</div>
        </div>
        <div class="mt-4">
            <ul>
                <li v-for="page in pages" :key="page">
                    <div class="flex items-center justify-between">
                        <div>{{ page.url }}</div>
                        <div>{{ page.total }}</div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
export default {
    name: "Pages",
    props: {
        pages: {
            type: Object,
            required: true,
        },
    },
};
</script>
