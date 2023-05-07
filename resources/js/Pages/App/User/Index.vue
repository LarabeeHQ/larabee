<script setup>
import { Link, Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/App/Master.vue";
import Pagination from "@/Components/Pagination.vue";
import countryHelper from "@/countryHelper";
import helper from "@/helper";

const { website, sessions } = defineProps({
    sessions: Object,
    website: Object,
});
</script>
<template>
    <AuthenticatedLayout>
        <Head title="Users" />

        <div class="min-w-0 flex-1 mb-4">
            <div class="-my-px">
                <div class="text-4xl font-bold text-black dark:text-white">
                    Users
                </div>
                <div class="text-sm font-medium text-zinc-800 dark:text-white">
                    {{ website.domain }}
                </div>
            </div>
        </div>
        <div class="">
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div
                        class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"
                    >
                        <div
                            class="overflow-hidden rounded-md border border-zinc-200 dark:border-zinc-700"
                        >
                            <table class="table">
                                <thead class="table-thead">
                                    <tr>
                                        <th scope="col" class="table-th">
                                            Name
                                        </th>
                                        <th scope="col" class="table-th">
                                            Page Views
                                        </th>
                                        <th scope="col" class="table-th">
                                            Country
                                        </th>
                                        <th scope="col" class="table-th">
                                            Last Seen
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="table-tbody">
                                    <tr
                                        v-for="session in sessions.data"
                                        :key="session.id"
                                    >
                                        <td class="table-td">
                                            <Link
                                                :href="
                                                    route(
                                                        'users.show',
                                                        session.id
                                                    )
                                                "
                                            >
                                                {{ session.id }}
                                            </Link>
                                        </td>
                                        <td class="table-td">
                                            <div>
                                                {{ session.page_views_count }}
                                            </div>
                                        </td>
                                        <td
                                            class="table-td flex items-center space-x-2"
                                        >
                                            <div>
                                                {{
                                                    countryHelper.getCountryFlag(
                                                        session.country
                                                    )
                                                }}
                                            </div>

                                            <div>
                                                {{
                                                    countryHelper.getCountryName(
                                                        session.country
                                                    )
                                                }}
                                            </div>
                                        </td>
                                        <td class="table-td">
                                            {{
                                                session.last_page_view
                                                    ? helper.formatDate(
                                                          session.last_page_view
                                                              ?.created_at
                                                      )
                                                    : "-"
                                            }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <Pagination :data="sessions" />
        </div>
    </AuthenticatedLayout>
</template>
