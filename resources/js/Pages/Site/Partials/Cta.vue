<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div class="relative isolate overflow-hidden bg-gray-900">
        <div class="py-24 px-6 sm:px-6 sm:py-32 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <h2
                    class="text-3xl font-bold tracking-tight text-white sm:text-4xl"
                >
                    Are you ready to Launch <br />
                    your SaaS today?
                </h2>
                <p
                    class="mx-auto mt-6 max-w-xl text-lg leading-8 text-gray-300"
                >
                    Setup up your new SaaS product in under 5 minutes with
                    Launch Stack. Contains all features you need to start your
                    own project including Billing, Admin, Website, Blog, and
                    more!
                </p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    <Link
                        :href="route('register')"
                        class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-900 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white"
                    >
                        Get started
                    </Link>
                    <a
                        href="#"
                        class="text-sm font-semibold leading-6 text-white"
                        >Learn more <span aria-hidden="true">→</span></a
                    >
                </div>
            </div>
        </div>
        <svg
            viewBox="0 0 1024 1024"
            class="absolute top-1/2 left-1/2 -z-10 h-[64rem] w-[64rem] -translate-x-1/2 [mask-image:radial-gradient(closest-side,white,transparent)]"
            aria-hidden="true"
        >
            <circle
                cx="512"
                cy="512"
                r="512"
                fill="url(#8d958450-c69f-4251-94bc-4e091a323369)"
                fill-opacity="0.7"
            />
            <defs>
                <radialGradient id="8d958450-c69f-4251-94bc-4e091a323369">
                    <stop stop-color="#7775D6" />
                    <stop offset="1" stop-color="#E935C1" />
                </radialGradient>
            </defs>
        </svg>
    </div>
</template>
