<script setup>
import { ref } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import { Dialog, DialogPanel } from "@headlessui/vue";
import {
    Bars3Icon,
    XMarkIcon,
    ArrowRightIcon,
} from "@heroicons/vue/24/outline";

const user = usePage().props.auth?.user;

const navigation = [
    { name: "Pricing", href: route("site.pricing") },
    { name: "Blog", href: "#" },
    { name: "Faq", href: route("site.faq") },
];

const mobileMenuOpen = ref(false);
</script>

<template>
    <header class="absolute inset-x-0 top-0 z-50">
        <nav
            class="flex items-center justify-between p-6 lg:px-8"
            aria-label="Global"
        >
            <div class="flex lg:flex-1">
                <Link :href="route('site.home')" class="-m-1.5 p-1.5">
                    <span class="sr-only">Your Company</span>
                    <img
                        class="h-8 w-auto"
                        src="/images/launchstack/logo-black.svg"
                        alt="Launch Stack"
                    />
                </Link>
            </div>
            <div class="flex lg:hidden">
                <button
                    type="button"
                    class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700"
                    @click="mobileMenuOpen = true"
                >
                    <span class="sr-only">Open main menu</span>
                    <Bars3Icon class="h-6 w-6" aria-hidden="true" />
                </button>
            </div>
            <div class="hidden lg:flex lg:gap-x-12">
                <Link
                    v-for="item in navigation"
                    :key="item.name"
                    :href="item.href"
                    class="text-sm font-semibold leading-6 text-gray-900 hover:text-gray-400"
                    >{{ item.name }}</Link
                >
            </div>
            <div
                v-if="user"
                class="hidden lg:flex lg:flex-1 lg:justify-end space-x-8"
            >
                <Link
                    :href="route('analytics')"
                    class="text-sm font-semibold leading-6 text-gray-900 hover:text-gray-400 flex items-center space-x-1.5"
                >
                    <div>Dashboard</div>
                    <ArrowRightIcon
                        class="h-4 w-4 stroke-2"
                        aria-hidden="true"
                    />
                </Link>
            </div>
            <div
                v-else
                class="hidden lg:flex lg:flex-1 lg:justify-end space-x-8"
            >
                <Link
                    :href="route('login')"
                    class="text-sm font-semibold leading-6 text-gray-900 hover:text-gray-400"
                >
                    Log in
                </Link>

                <Link
                    :href="route('register')"
                    class="text-sm font-semibold leading-6 text-gray-900 hover:text-gray-400"
                >
                    Register
                </Link>
            </div>
        </nav>
        <Dialog
            as="div"
            class="lg:hidden"
            @close="mobileMenuOpen = false"
            :open="mobileMenuOpen"
        >
            <div class="fixed inset-0 z-50" />
            <DialogPanel
                class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10"
            >
                <div class="flex items-center justify-between">
                    <a href="#" class="-m-1.5 p-1.5">
                        <span class="sr-only">Your Company</span>
                        <img
                            class="h-8 w-auto"
                            src="/images/launchstack/logo-black.svg"
                            alt="Launch Stack"
                        />
                    </a>
                    <button
                        type="button"
                        class="-m-2.5 rounded-md p-2.5 text-gray-700"
                        @click="mobileMenuOpen = false"
                    >
                        <span class="sr-only">Close menu</span>
                        <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                    </button>
                </div>
                <div class="mt-6 flow-root">
                    <div class="-my-6 divide-y divide-gray-500/10">
                        <div class="space-y-2 py-6">
                            <Link
                                v-for="item in navigation"
                                :key="item.name"
                                :href="item.href"
                                class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50"
                            >
                                {{ item.name }}
                            </Link>
                        </div>
                        <div v-if="user" class="py-6">
                            <Link
                                :href="route('analytics')"
                                class="-mx-3 block rounded-lg py-2.5 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 flex items-center space-x-1.5"
                            >
                                <div>Dashboard</div>
                                <ArrowRightIcon
                                    class="h-4 w-4 stroke-2"
                                    aria-hidden="true"
                                />
                            </Link>
                        </div>
                        <div v-else class="py-6">
                            <Link
                                :href="route('login')"
                                class="-mx-3 block rounded-lg py-2.5 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50"
                            >
                                Log in
                            </Link>

                            <Link
                                :href="route('register')"
                                class="-mx-3 block rounded-lg py-2.5 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50"
                            >
                                Register
                            </Link>
                        </div>
                    </div>
                </div>
            </DialogPanel>
        </Dialog>
    </header>
</template>
