<script setup>
const featuredTestimonial = {
    body: "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.",
    author: {
        name: "Paulo Castellano",
        twitter: "@paulocastellano",
        image: "https://pbs.twimg.com/profile_images/1468766436382416897/uLSNzTWt_200x200.jpg",
    },
};
const testimonials = [
    [
        [
            {
                body: "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout",
                author: {
                    name: "Paulo Castellano",
                    twitter: "@paulocastellano",
                    image: "https://pbs.twimg.com/profile_images/1468766436382416897/uLSNzTWt_200x200.jpg",
                },
            },
            {
                body: "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout",
                author: {
                    name: "Paulo Castellano",
                    twitter: "@paulocastellano",
                    image: "https://pbs.twimg.com/profile_images/1468766436382416897/uLSNzTWt_200x200.jpg",
                },
            },
        ],
        [
            {
                body: "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout",
                author: {
                    name: "Paulo Castellano",
                    twitter: "@paulocastellano",
                    image: "https://pbs.twimg.com/profile_images/1468766436382416897/uLSNzTWt_200x200.jpg",
                },
            },
        ],
    ],
    [
        [
            {
                body: "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout",
                author: {
                    name: "Paulo Castellano",
                    twitter: "@paulocastellano",
                    image: "https://pbs.twimg.com/profile_images/1468766436382416897/uLSNzTWt_200x200.jpg",
                },
            },
        ],
        [
            {
                body: "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout",
                author: {
                    name: "Paulo Castellano",
                    twitter: "@paulocastellano",
                    image: "https://pbs.twimg.com/profile_images/1468766436382416897/uLSNzTWt_200x200.jpg",
                },
            },
            {
                body: "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout",
                author: {
                    name: "Paulo Castellano",
                    twitter: "@paulocastellano",
                    image: "https://pbs.twimg.com/profile_images/1468766436382416897/uLSNzTWt_200x200.jpg",
                },
            },
        ],
    ],
];
</script>

<template>
    <div class="relative isolate bg-white pt-24 pb-32 sm:pt-32">
        <div
            class="absolute inset-x-0 top-1/2 -z-10 -translate-y-1/2 transform-gpu overflow-hidden opacity-30 blur-3xl"
        >
            <svg
                viewBox="0 0 1313 771"
                aria-hidden="true"
                class="ml-[max(50%,38rem)] w-[82.0625rem]"
            >
                <path
                    id="bc169a03-3518-42d4-ab1e-d3eadac65edc"
                    fill="url(#85a0eca5-25f1-4ab9-af84-4e2d8d9cdbf3)"
                    d="M360.508 589.796 231.671 770.522 0 498.159l360.508 91.637 232.034-325.485c1.485 150.396 51.235 393.965 238.354 165.069C1064.79 143.261 1002.42-107.094 1171.72 46.97c135.44 123.252 148.51 335.641 138.11 426.428L971.677 339.803l24.062 411.461-635.231-161.468Z"
                />
                <defs>
                    <linearGradient
                        id="85a0eca5-25f1-4ab9-af84-4e2d8d9cdbf3"
                        x1="1313.17"
                        x2="-88.881"
                        y1=".201"
                        y2="539.417"
                        gradientUnits="userSpaceOnUse"
                    >
                        <stop stop-color="#9089FC" />
                        <stop offset="1" stop-color="#FF80B5" />
                    </linearGradient>
                </defs>
            </svg>
        </div>
        <div
            class="absolute inset-x-0 top-0 -z-10 flex transform-gpu overflow-hidden pt-32 opacity-25 blur-3xl sm:pt-40 xl:justify-end"
        >
            <svg
                viewBox="0 0 1313 771"
                aria-hidden="true"
                class="ml-[-22rem] w-[82.0625rem] flex-none origin-top-right rotate-[30deg] xl:ml-0 xl:mr-[calc(50%-12rem)]"
            >
                <use href="#bc169a03-3518-42d4-ab1e-d3eadac65edc" />
            </svg>
        </div>
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-xl text-center">
                <h2
                    class="text-lg font-semibold leading-8 tracking-tight text-indigo-600"
                >
                    Testimonials
                </h2>
                <p
                    class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl"
                >
                    What people are saying about us
                </p>
            </div>
            <div
                class="mx-auto mt-16 grid max-w-2xl grid-cols-1 grid-rows-1 gap-8 text-sm leading-6 text-gray-900 sm:mt-20 sm:grid-cols-2 xl:mx-0 xl:max-w-none xl:grid-flow-col xl:grid-cols-4"
            >
                <figure
                    class="col-span-2 hidden sm:block sm:rounded-2xl sm:bg-white sm:shadow-lg sm:ring-1 sm:ring-gray-900/5 xl:col-start-2 xl:row-end-1"
                >
                    <blockquote
                        class="p-12 pb-4 text-xl font-semibold leading-8 tracking-tight text-gray-900"
                    >
                        <p>{{ `“${featuredTestimonial.body}”` }}</p>
                    </blockquote>
                    <figcaption class="flex items-center gap-x-4 py-4 px-6">
                        <img
                            class="h-10 w-10 flex-none rounded-full bg-gray-50"
                            :src="featuredTestimonial.author.image"
                            :alt="featuredTestimonial.author.name"
                        />
                        <div class="flex-auto">
                            <div class="font-semibold">
                                {{ featuredTestimonial.author.name }}
                            </div>
                            <div class="text-gray-600">
                                {{ featuredTestimonial.author.twitter }}
                            </div>
                        </div>
                    </figcaption>
                </figure>
                <div
                    v-for="(columnGroup, columnGroupIdx) in testimonials"
                    :key="columnGroupIdx"
                    class="space-y-8 xl:contents xl:space-y-0"
                >
                    <div
                        v-for="(column, columnIdx) in columnGroup"
                        :key="columnIdx"
                        :class="[
                            (columnGroupIdx === 0 && columnIdx === 0) ||
                            (columnGroupIdx === testimonials.length - 1 &&
                                columnIdx === columnGroup.length - 1)
                                ? 'xl:row-span-2'
                                : 'xl:row-start-1',
                            'space-y-8',
                        ]"
                    >
                        <figure
                            v-for="testimonial in column"
                            :key="testimonial.author.twitter"
                            class="rounded-2xl bg-white p-6 shadow-lg ring-1 ring-gray-900/5"
                        >
                            <blockquote class="text-gray-900">
                                <p>{{ `“${testimonial.body}”` }}</p>
                            </blockquote>
                            <figcaption class="mt-6 flex items-center gap-x-4">
                                <img
                                    class="h-10 w-10 rounded-full bg-gray-50"
                                    :src="testimonial.author.image"
                                    :alt="testimonial.author.name"
                                />
                                <div>
                                    <div class="font-semibold">
                                        {{ testimonial.author.name }}
                                    </div>
                                    <div class="text-gray-600">
                                        {{ testimonial.author.twitter }}
                                    </div>
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
