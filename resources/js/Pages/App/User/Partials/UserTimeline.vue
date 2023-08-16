<script setup>
import helper from "@/helper";
import { EyeIcon, BoltIcon } from "@heroicons/vue/24/solid";
defineProps({
    eventDates: Object,
});
</script>
<template>
    <div class="col-span-3">
        <div class="space-y-4">
            <div v-for="(eventDate, date) in eventDates" :key="date">
                <div class="text-sm font-semibold mb-1 text-gray-800 dark:text-gray-300">
                    {{ helper.formatDate(date) }}
                </div>
                <div class="space-y-2">
                    <div v-for="(event, eventId) in eventDate" :key="event">
                        <div class="relative">
                            <span
                                v-if="eventId !== eventDate.length - 1"
                                class="absolute left-6 top-4 h-full -ml-px w-0.5 bg-zinc-300 dark:bg-zinc-700"
                                aria-hidden="true"
                            />
                            <div class="relative card">
                                <div
                                    class="flex items-center justify-between px-4 py-2"
                                >
                                    <div
                                        v-if="event.type == 'page_view'"
                                        class="flex items-center space-x-2"
                                    >
                                        <EyeIcon
                                            v-tippy="{
                                                content: 'Page View',
                                            }"
                                            class="h-4 w-4 stroke-2"
                                        />
                                        <div
                                            v-tippy="{
                                                content: event.title,
                                                placement: 'top',
                                            }"
                                        >
                                            {{ event.url }}
                                        </div>
                                    </div>
                                    <div
                                        v-else
                                        class="flex items-center space-x-2"
                                    >
                                        <BoltIcon
                                            v-tippy="{
                                                content: 'Event',
                                            }"
                                            class="h-4 w-4 stroke-2"
                                        />
                                        <div>{{ event.name }}</div>
                                    </div>
                                    <div>
                                        {{
                                            helper.formatTime(event.created_at)
                                        }}
                                    </div>
                                </div>
                                <div
                                    v-if="event.type == 'event' && event.data"
                                    class="py-2 px-4"
                                >
                                    <div
                                        v-for="(value, key) in event.data"
                                        :key="key"
                                        class="flex items-center text-sm"
                                    >
                                        <div class="font-semibold">
                                            {{ key }}
                                        </div>
                                        <div>:</div>
                                        <div class="ml-1">
                                            {{ value }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                v-if="
                                    event.type == 'page_view' && event.referrer
                                "
                                class="relative overflow-hidden flex items-center py-1.5 -ml-px"
                            >
                                <div
                                    class="absolute border-2 border-r-0 left-6 w-5 h-16 border-zinc-300 dark:border-zinc-700 bottom-[50%] transform translate-y-px rounded-l-lg"
                                ></div>
                                <div class="overflow-hidden ml-11 card">
                                    <div
                                        class="flex items-center space-x-1 px-2 py-1"
                                    >
                                        <div
                                            class="overflow-hidden rounded min-w-[1rem]"
                                        >
                                            <img
                                                :src="
                                                    route(
                                                        'websites.favicon',
                                                        event.referrer
                                                    )
                                                "
                                                class="w-4 h-4 transition-all opacity-100"
                                                :alt="event.referrer"
                                            />
                                        </div>
                                        <a
                                            class="transition-all duration-75 group-hover:text-gray-800 truncate"
                                            target="_blank"
                                            :href="`https://${event.referrer}`"
                                        >
                                            {{ event.referrer }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
