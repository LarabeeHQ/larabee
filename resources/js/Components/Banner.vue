<template>
    <div
        v-if="show && message"
        aria-live="assertive"
        class="fixed inset-0 flex px-4 py-6 pointer-events-none sm:p-6 sm:items-start z-50"
    >
        <div
            class="w-full flex flex-col absolute bottom-0 mb-4 items-center space-y-4 justify-center"
        >
            <transition
                enter-active-class="transform ease-out duration-300 transition"
                enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
                leave-active-class="transition ease-in duration-100"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <div
                    class="max-w-sm w-full bg-gray-900 shadow-2xl rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden"
                >
                    <div class="px-4 py-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <CheckCircleIcon
                                    v-if="style == 'success'"
                                    class="h-5 w-5 text-green-400 stroke-2"
                                    aria-hidden="true"
                                />
                                <XCircleIcon
                                    v-if="style == 'danger'"
                                    class="h-5 w-5 text-red-400 stroke-2"
                                    aria-hidden="true"
                                />
                                <InformationCircleIcon
                                    v-if="style == 'info'"
                                    class="h-5 w-5 text-blue-400 stroke-2"
                                    aria-hidden="true"
                                />
                                <ExclamationCircleIcon
                                    v-if="style == 'warning'"
                                    class="h-5 w-5 text-yellow-400 stroke-2"
                                    aria-hidden="true"
                                />
                            </div>
                            <div
                                class="ml-2 w-0 flex-1 text-sm text-gray-300 font-semibold"
                            >
                                {{ message }}
                            </div>
                            <div class="ml-4 flex-shrink-0 flex">
                                <button
                                    @click="show = false"
                                    class="inline-flex text-gray-500 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                >
                                    <span class="sr-only">Close</span>
                                    <XMarkIcon
                                        class="h-5 w-5"
                                        aria-hidden="true"
                                    />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
import {
    XMarkIcon,
    CheckCircleIcon,
    XCircleIcon,
    InformationCircleIcon,
    ExclamationCircleIcon,
} from "@heroicons/vue/24/solid";

export default {
    components: {
        CheckCircleIcon,
        XMarkIcon,
        XCircleIcon,
        InformationCircleIcon,
        ExclamationCircleIcon,
    },

    data() {
        return {
            show: true,
        };
    },

    watch: {
        "$page.props.flash": {
            handler() {
                this.show = true;
                setTimeout(() => {
                    this.show = false;
                }, 3000);
            },
            deep: true,
        },
    },

    computed: {
        style() {
            return this.$page.props.flash?.bannerStyle || "success";
        },

        message() {
            return this.$page.props.flash?.banner || "";
        },
    },
};
</script>
