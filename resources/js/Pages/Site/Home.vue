<script setup>
import { Head, Link } from "@inertiajs/vue3";
import WebsiteLayout from "@/Layouts/Site/Master.vue";
import Testimonial from "./Partials/Testimonial.vue";
import Cta from "./Partials/Cta.vue";

import {
    CommandLineIcon,
    LockClosedIcon,
    AdjustmentsHorizontalIcon,
    ArrowPathIcon,
    UsersIcon,
    UserCircleIcon,
    CloudArrowUpIcon,
    ComputerDesktopIcon,
    CreditCardIcon,
    HandThumbUpIcon,
    BookOpenIcon,
    KeyIcon,
    DocumentTextIcon,
    PaintBrushIcon,
    BellIcon,
    AcademicCapIcon,
    ArrowPathRoundedSquareIcon,
    CodeBracketIcon,
    Square3Stack3DIcon,
    RectangleStackIcon,
    LanguageIcon,
    ChatBubbleBottomCenterTextIcon,
    SunIcon,
    RocketLaunchIcon,
} from "@heroicons/vue/24/outline";

const features = [
    {
        name: "Website & Blog",
        description:
            "A complete website and Blog with: a home page, pricing, features, terms, privacy, and more.",
        icon: ComputerDesktopIcon,
    },
    {
        name: "i18n",
        description:
            "Ready for you to add all languages required in your project.",
        icon: LanguageIcon,
    },
    {
        name: "Dark Mode",
        description:
            "All apps today have a dark mode available, why you not will have one?",
        icon: SunIcon,
    },
    {
        name: "Admin area",
        description:
            "A complete admin area for you to manage your business, with a users list, growth chart, and more.",
        icon: AdjustmentsHorizontalIcon,
    },
    {
        name: "Subscription Payments",
        description:
            "Pre-built Paddle billing system for you to monetize your SaaS app.",
        icon: CreditCardIcon,
    },
    {
        name: "Vue and Tailwind UI",
        description:
            "Pre-build Tailwind styled components with vue 3 - no design skills required.",
        icon: PaintBrushIcon,
    },
    {
        name: "Users & Authentication",
        description:
            "Ensure secure login with measures against brute-force attacks, automatic account lockouts, and the implementation of two-factor authentication.",
        icon: UserCircleIcon,
    },
    {
        name: "User management",
        description:
            "Effortlessly manage your user base through the central management app, eliminating the need for manual database searches.",
        icon: UserCircleIcon,
    },
    {
        name: "Team management",
        description:
            "Enable users to collaborate with their teammates through an effortless invitation process.",
        icon: UsersIcon,
    },
    {
        name: "API",
        description:
            "Experience lightning-fast performance with our REST API, featuring secure token authentication and API key management.",
        icon: CodeBracketIcon,
    },
    {
        name: "Social Login",
        description: "Over 10+ social networks supported for user login.",
        icon: HandThumbUpIcon,
    },
    {
        name: "User Feedback",
        description:
            "Collect user feedback and access reports directly, without the need for additional external tools.",
        icon: ChatBubbleBottomCenterTextIcon,
    },
    {
        name: "User Onboarding",
        description:
            "Increase user engagement and retention with user-onboarding.",
        icon: RocketLaunchIcon,
    },
    {
        name: "User Notifications",
        description:
            "Send in-app notifications without touching a single line of code.",
        icon: BellIcon,
    },
    {
        name: "Command Palette",
        description:
            "Allow fast access to your killer features with a simple shortcut.",
        icon: CommandLineIcon,
    },
    {
        name: "Documentation",
        description:
            "LaunchStack is strongly documented. If you have any questions, just contact us through our Discord channel.",
        icon: BookOpenIcon,
    },
    {
        name: "1 Year of updates",
        description:
            "Github access with continuous updates and only $149/yr after the first year.",
        icon: ArrowPathRoundedSquareIcon,
    },
    {
        name: "Discord Community",
        description:
            "Get access to our private community of seasoned developers and stay connected.",
        icon: AcademicCapIcon,
    },
    {
        name: "Components",
        description:
            "Benefit from a wealth of pre-constructed components, a tailored API, a flexible layout system, and an abundance of other features.",
        icon: Square3Stack3DIcon,
    },
    {
        name: "Automated Tests",
        description:
            "Quickly track down and eliminate bugs through the use of integration testing.",
        icon: RectangleStackIcon,
    },
    {
        name: "Terms and Policies",
        description:
            "Terms of use and privacy policy are included for you start faster.",
        icon: CloudArrowUpIcon,
    },
];
</script>
<template>
    <Head title="Home" />
    <WebsiteLayout>
        <div class="relative isolate pt-14">
            <div
                class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
            >
                <svg
                    class="relative left-[calc(50%-11rem)] -z-10 h-[21.1875rem] max-w-none -translate-x-1/2 rotate-[30deg] sm:left-[calc(50%-30rem)] sm:h-[42.375rem]"
                    viewBox="0 0 1155 678"
                >
                    <path
                        fill="url(#9b2541ea-d39d-499b-bd42-aeea3e93f5ff)"
                        fill-opacity=".3"
                        d="M317.219 518.975L203.852 678 0 438.341l317.219 80.634 204.172-286.402c1.307 132.337 45.083 346.658 209.733 145.248C936.936 126.058 882.053-94.234 1031.02 41.331c119.18 108.451 130.68 295.337 121.53 375.223L855 299l21.173 362.054-558.954-142.079z"
                    />
                    <defs>
                        <linearGradient
                            id="9b2541ea-d39d-499b-bd42-aeea3e93f5ff"
                            x1="1155.49"
                            x2="-78.208"
                            y1=".177"
                            y2="474.645"
                            gradientUnits="userSpaceOnUse"
                        >
                            <stop stop-color="#9089FC" />
                            <stop offset="1" stop-color="#FF80B5" />
                        </linearGradient>
                    </defs>
                </svg>
            </div>
            <div class="py-24 sm:py-32 lg:pb-40">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <div class="mx-auto max-w-3xl text-center">
                        <h1
                            class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl"
                        >
                            Are you ready to Launch your SaaS today?
                        </h1>
                        <p class="mt-6 text-lg leading-8 text-gray-600">
                            Setup up your SaaS product in under 5 minutes with
                            Launch Stack. Contains all features you need to
                            start your own project including Billing, Admin,
                            Website, Blog, and more!
                        </p>
                        <div
                            class="mt-10 flex items-center justify-center gap-x-6"
                        >
                            <Link
                                :href="route('register')"
                                class="rounded-md bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                            >
                                Get started
                            </Link>
                        </div>
                    </div>
                    <div class="mt-16 flow-root sm:mt-24">
                        <div
                            class="-m-2 rounded-xl bg-gray-900/5 p-2 ring-1 ring-inset ring-gray-900/10 lg:-m-4 lg:rounded-2xl lg:p-4"
                        >
                            <img
                                src="https://via.placeholder.com/2432x1442"
                                alt="Launch Stack"
                                width="2432"
                                height="1442"
                                class="rounded-md shadow-2xl ring-1 ring-gray-900/10"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <Testimonial />

        <div class="bg-white py-24 sm:py-32">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl lg:text-center">
                    <h2 class="text-base font-semibold leading-7 text-blue-600">
                        Build faster
                    </h2>
                    <p
                        class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl"
                    >
                        Everything you dreamed of to create your SaaS
                    </p>
                    <p class="mt-6 text-lg leading-8 text-gray-600">
                        Launch Stack it's based on Laravel, TailwindCSS and Vue
                        3
                    </p>
                </div>
                <div
                    class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none"
                >
                    <dl
                        className="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3"
                    >
                        <div
                            v-for="feature in features"
                            :key="feature.name"
                            class="flex flex-col"
                        >
                            <dt
                                className="flex items-center gap-x-3 text-base font-semibold leading-7 text-gray-900"
                            >
                                <div class="bg-blue-50 p-2 rounded-md">
                                    <component
                                        :is="feature.icon"
                                        class="h-6 w-6 flex-none text-blue-600 stroke-2"
                                        aria-hidden="true"
                                    />
                                </div>

                                {{ feature.name }}
                            </dt>

                            <dd
                                class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600"
                            >
                                {{ feature.description }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <Cta />
    </WebsiteLayout>
</template>
