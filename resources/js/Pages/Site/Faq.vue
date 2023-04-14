<script setup>
import { Link, Head } from "@inertiajs/vue3";
import { Disclosure, DisclosureButton, DisclosurePanel } from "@headlessui/vue";
import { MinusSmallIcon, PlusSmallIcon } from "@heroicons/vue/24/outline";

import WebsiteLayout from "@/Layouts/Site/Master.vue";

const faqs = [
    {
        question: "What's the best thing about Switzerland?",
        answer: "I don't know, but the flag is a big plus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas cupiditate laboriosam fugiat.",
    },
    {
        question: "What's the best thing about Switzerland?",
        answer: "I don't know, but the flag is a big plus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas cupiditate laboriosam fugiat.",
    },
    {
        question: "What's the best thing about Switzerland?",
        answer: "I don't know, but the flag is a big plus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas cupiditate laboriosam fugiat.",
    },
    {
        question: "What's the best thing about Switzerland?",
        answer: "I don't know, but the flag is a big plus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas cupiditate laboriosam fugiat.",
    },
    {
        question: "What's the best thing about Switzerland?",
        answer: "I don't know, but the flag is a big plus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas cupiditate laboriosam fugiat.",
    },
    {
        question: "What's the best thing about Switzerland?",
        answer: "I don't know, but the flag is a big plus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas cupiditate laboriosam fugiat.",
    },
    {
        question: "What's the best thing about Switzerland?",
        answer: "I don't know, but the flag is a big plus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas cupiditate laboriosam fugiat.",
    },
    {
        question: "What's the best thing about Switzerland?",
        answer: "I don't know, but the flag is a big plus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas cupiditate laboriosam fugiat.",
    },
];
</script>
<template>
    <Head title="FAQ" />

    <WebsiteLayout>
        <div class="bg-white mt-20">
            <div class="mx-auto max-w-7xl py-16 px-6 sm:py-24 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <h1
                        class="text-2xl font-bold leading-10 tracking-tight text-gray-900"
                    >
                        Frequently asked questions
                    </h1>
                    <p class="mt-6 text-base leading-7 text-gray-600">
                        Have a different question and can’t find the answer
                        you’re looking for? Reach out to our support team by
                        <a
                            href="#"
                            class="font-semibold text-indigo-600 hover:text-indigo-500"
                            >sending us an email</a
                        >
                        and we’ll get back to you as soon as we can.
                    </p>
                </div>
                <div class="mt-20">
                    <dl
                        class="space-y-16 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:gap-y-16 sm:space-y-0 lg:grid-cols-2 lg:gap-x-10"
                    >
                        <div v-for="faq in faqs" :key="faq">
                            <dt
                                class="text-base font-semibold leading-7 text-gray-900"
                            >
                                {{ faq.question }}
                            </dt>
                            <dd class="mt-2 text-base leading-7 text-gray-600">
                                {{ faq.answer }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </WebsiteLayout>
</template>
