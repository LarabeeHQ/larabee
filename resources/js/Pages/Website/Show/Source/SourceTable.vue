<template>
    <Table v-if="data" :data="data" />
</template>
<script>
import Table from "@/Components/Table.vue";
export default {
    components: {
        Table,
    },
    props: ["dateRange", "website"],

    data() {
        return {
            data: null,
        };
    },
    mounted() {
        this.loadData();
    },

    watch: {
        dateRange() {
            this.loadData();
        },
    },

    methods: {
        loadData() {
            axios
                .get(route("websites.statistics", this.website.id), {
                    params: {
                        start: this.dateRange.start,
                        end: this.dateRange.end,
                        metric: "utm-sources",
                    },
                })
                .then((response) => {
                    this.data = response.data;
                });
        },
    },
};
</script>
