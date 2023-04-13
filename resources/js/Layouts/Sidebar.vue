<script setup>
import { usePage, Link } from "@inertiajs/vue3";
import { ref, computed, reactive } from "vue";
import {
    Dialog,
    DialogPanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";

import {
    UserCircleIcon,
    Bars3Icon,
    Cog6ToothIcon,
    HomeIcon,
    XMarkIcon,
    BookOpenIcon,
    LightBulbIcon,
    TruckIcon,
    ShieldCheckIcon,
    BookmarkSquareIcon,
    ChatBubbleOvalLeftEllipsisIcon,
    QuestionMarkCircleIcon,
    CreditCardIcon,
    PowerIcon,
} from "@heroicons/vue/24/outline";
import { BoltIcon } from "@heroicons/vue/24/solid";

import ModalUpgrade from "@/Pages/Billing/ModalUpgrade.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

const showingNavigationDropdown = ref(false);
const modalUpgrade = ref(null);

const sidebarOpen = ref(false);
const user = computed(() => usePage().props.auth.user);
const selfHosted = computed(() => usePage().props.self_hosted);

const navigation = [
    {
        name: "Dashboard",
        href: route("dashboard"),
        icon: HomeIcon,
        current: route().current("dashboard"),
    },
];
const websites = reactive(
    user.value.websites.map((website) => ({
        ...website,
        href: route("websites.show", website.id),
        current: route().current("websites.*", website.id),
        initial: website.name.charAt(0),
    }))
);

const openModalUpgrade = () => {
    modalUpgrade.value.open();
    sidebarOpen.value = false;
};
</script>

<template>
    <TransitionRoot as="template" :show="sidebarOpen">
        <Dialog
            as="div"
            class="relative z-50 lg:hidden"
            @close="sidebarOpen = false"
        >
            <TransitionChild
                as="template"
                enter="transition-opacity ease-linear duration-300"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="transition-opacity ease-linear duration-300"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-zinc-900/80" />
            </TransitionChild>

            <div class="fixed inset-0 flex">
                <TransitionChild
                    as="template"
                    enter="transition ease-in-out duration-300 transform"
                    enter-from="-translate-x-full"
                    enter-to="translate-x-0"
                    leave="transition ease-in-out duration-300 transform"
                    leave-from="translate-x-0"
                    leave-to="-translate-x-full"
                >
                    <DialogPanel
                        class="relative mr-16 flex w-full max-w-xs flex-1"
                    >
                        <TransitionChild
                            as="template"
                            enter="ease-in-out duration-300"
                            enter-from="opacity-0"
                            enter-to="opacity-100"
                            leave="ease-in-out duration-300"
                            leave-from="opacity-100"
                            leave-to="opacity-0"
                        >
                            <div
                                class="absolute left-full top-0 flex w-16 justify-center pt-5"
                            >
                                <button
                                    type="button"
                                    class="-m-2.5 p-2.5"
                                    @click="sidebarOpen = false"
                                >
                                    <span class="sr-only">Close sidebar</span>
                                    <XMarkIcon
                                        class="h-6 w-6 text-white"
                                        aria-hidden="true"
                                    />
                                </button>
                            </div>
                        </TransitionChild>
                        <!-- Sidebar component, swap this element with another sidebar if you like -->
                        <div
                            class="flex grow flex-col gap-y-5 overflow-y-auto bg-zinc-800 px-6 pb-2 ring-1 ring-white/10"
                        >
                            <div class="flex h-16 shrink-0 items-center">
                                <ApplicationLogo class="h-8 w-auto" />
                            </div>
                            <nav class="flex flex-1 flex-col">
                                <ul
                                    role="list"
                                    class="flex flex-1 flex-col gap-y-7"
                                >
                                    <li>
                                        <ul role="list" class="-mx-2 space-y-1">
                                            <li
                                                v-for="item in navigation"
                                                :key="item.name"
                                            >
                                                <Link
                                                    :href="item.href"
                                                    :class="[
                                                        item.current
                                                            ? 'bg-zinc-900 text-white'
                                                            : 'text-zinc-400 hover:text-white hover:bg-zinc-900',
                                                        'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold',
                                                    ]"
                                                >
                                                    <component
                                                        :is="item.icon"
                                                        class="h-6 w-6 shrink-0"
                                                        aria-hidden="true"
                                                    />
                                                    {{ item.name }}
                                                </Link>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <Link
                                            :href="route('websites.create')"
                                            class="-mx-2 mb-2 text-white bg-blue-600 rounded-md px-4 py-2 flex text-sm"
                                        >
                                            New Website
                                        </Link>
                                        <div
                                            class="text-xs font-semibold leading-6 text-zinc-400"
                                        >
                                            Your websites
                                        </div>

                                        <ul
                                            role="list"
                                            class="-mx-2 mt-2 space-y-1"
                                        >
                                            <li
                                                v-for="website in websites"
                                                :key="website.name"
                                            >
                                                <Link
                                                    :href="website.href"
                                                    :class="[
                                                        website.current
                                                            ? 'bg-zinc-900 text-white'
                                                            : 'text-zinc-400 hover:text-white hover:bg-zinc-900 hover:bg-opacity-50',
                                                        'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold',
                                                    ]"
                                                >
                                                    <span
                                                        class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border border-zinc-700 bg-zinc-800 text-[0.625rem] font-medium text-zinc-400 group-hover:text-white"
                                                        >{{
                                                            website.initial
                                                        }}</span
                                                    >
                                                    <span class="truncate">{{
                                                        website.name
                                                    }}</span>
                                                </Link>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <ul class="mt-auto">
                                    <li class="mt-auto">
                                        <div
                                            v-if="
                                                !selfHosted &&
                                                user.plan.name == 'trial'
                                            "
                                            @click.prevent="openModalUpgrade"
                                            class="group w-full -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-bold leading-6 hover:bg-zinc-800 text-fuchsia-500 hover:text-fuchsia-600"
                                        >
                                            <BoltIcon
                                                class="h-6 w-6 shrink-0 troke-2"
                                                aria-hidden="true"
                                            />
                                            Upgrade
                                        </div>
                                    </li>

                                    <li>
                                        <Menu
                                            as="div"
                                            class="relative inline-block text-left w-full"
                                        >
                                            <div class="w-full">
                                                <MenuButton
                                                    class="w-full group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-zinc-400 hover:bg-zinc-800 hover:text-white"
                                                >
                                                    <QuestionMarkCircleIcon
                                                        class="h-6 w-6 shrink-0 stroke-2"
                                                    />
                                                    Help & Support
                                                </MenuButton>
                                            </div>

                                            <transition
                                                enter-active-class="transition ease-out duration-100"
                                                enter-from-class="transform opacity-0 scale-95"
                                                enter-to-class="transform opacity-100 scale-100"
                                                leave-active-class="transition ease-in duration-75"
                                                leave-from-class="transform opacity-100 scale-100"
                                                leave-to-class="transform opacity-0 scale-95"
                                            >
                                                <MenuItems
                                                    class="absolute left-0 z-10 mb-12 bottom-0 w-52 divide-y divide-zinc-100 origin-bottom-left rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none"
                                                >
                                                    <div class="py-1">
                                                        <MenuItem
                                                            v-slot="{ active }"
                                                        >
                                                            <a
                                                                href="https://docs.wanalytics.io"
                                                                target="_blank"
                                                                :class="[
                                                                    active
                                                                        ? 'bg-zinc-100 text-zinc-800'
                                                                        : 'text-zinc-700',
                                                                    'px-3 py-1 text-[13px] font-medium flex items-center',
                                                                ]"
                                                            >
                                                                <BookOpenIcon
                                                                    class="mr-2 flex-shrink-0 h-4 w-4 text-zinc-600 stroke-2"
                                                                />
                                                                Documentation</a
                                                            >
                                                        </MenuItem>

                                                        <MenuItem
                                                            v-slot="{ active }"
                                                        >
                                                            <a
                                                                href="#"
                                                                :class="[
                                                                    active
                                                                        ? 'bg-zinc-100 text-zinc-800'
                                                                        : 'text-zinc-700',
                                                                    'px-3 py-1 text-[13px] font-medium flex items-center',
                                                                ]"
                                                            >
                                                                <ChatBubbleOvalLeftEllipsisIcon
                                                                    class="mr-2 flex-shrink-0 h-4 w-4 text-zinc-600 stroke-2"
                                                                />
                                                                Live Support</a
                                                            >
                                                        </MenuItem>
                                                        <MenuItem
                                                            v-slot="{ active }"
                                                        >
                                                            <a
                                                                href="https://feedback.changelogfy.com/feature-requests"
                                                                target="_blank"
                                                                :class="[
                                                                    active
                                                                        ? 'bg-zinc-100 text-zinc-800'
                                                                        : 'text-zinc-700',
                                                                    ' px-3 py-1 text-[13px] font-medium flex items-center',
                                                                ]"
                                                            >
                                                                <LightBulbIcon
                                                                    class="mr-2 flex-shrink-0 h-4 w-4 text-zinc-600 stroke-2"
                                                                />
                                                                Give us
                                                                feedback</a
                                                            >
                                                        </MenuItem>
                                                    </div>
                                                    <div class="py-1">
                                                        <MenuItem
                                                            v-slot="{ active }"
                                                        >
                                                            <a
                                                                href="https://status.changelogfy.com"
                                                                target="_blank"
                                                                :class="[
                                                                    active
                                                                        ? 'bg-zinc-100 text-zinc-800'
                                                                        : 'text-zinc-700',
                                                                    ' px-3 py-1 text-[13px] font-medium flex items-center',
                                                                ]"
                                                            >
                                                                <img
                                                                    src="https://status.changelogfy.com/includes/badge/?healthy=07c707"
                                                                    alt=""
                                                                    class="mr-2 flex-shrink-0 h-3 w-3 rounded-full"
                                                                />

                                                                System Status</a
                                                            >
                                                        </MenuItem>

                                                        <MenuItem
                                                            v-slot="{ active }"
                                                        >
                                                            <a
                                                                href="https://feedback.changelogfy.com"
                                                                target="_blank"
                                                                :class="[
                                                                    active
                                                                        ? 'bg-zinc-100 text-zinc-800'
                                                                        : 'text-zinc-700',
                                                                    ' px-3 py-1 text-[13px] font-medium flex items-center',
                                                                ]"
                                                            >
                                                                <TruckIcon
                                                                    class="mr-2 flex-shrink-0 h-4 w-4 text-zinc-600 stroke-2"
                                                                />
                                                                Product
                                                                Roadmap</a
                                                            >
                                                        </MenuItem>
                                                    </div>

                                                    <div class="py-1">
                                                        <MenuItem
                                                            v-slot="{ active }"
                                                        >
                                                            <a
                                                                href="https://changelogfy.com/privacy"
                                                                target="_blank"
                                                                :class="[
                                                                    active
                                                                        ? 'bg-zinc-100 text-zinc-800'
                                                                        : 'text-zinc-700',
                                                                    ' px-3 py-1 text-[13px] font-medium flex items-center',
                                                                ]"
                                                            >
                                                                <ShieldCheckIcon
                                                                    class="mr-2 flex-shrink-0 h-4 w-4 text-zinc-600 stroke-2"
                                                                />
                                                                Privacy
                                                                Policy</a
                                                            >
                                                        </MenuItem>

                                                        <MenuItem
                                                            v-slot="{ active }"
                                                        >
                                                            <a
                                                                href="https://changelogfy.com/terms"
                                                                target="_blank"
                                                                :class="[
                                                                    active
                                                                        ? 'bg-zinc-100 text-zinc-800'
                                                                        : 'text-zinc-700',
                                                                    ' px-3 py-1 text-[13px] font-medium flex items-center',
                                                                ]"
                                                            >
                                                                <BookmarkSquareIcon
                                                                    class="mr-2 flex-shrink-0 h-4 w-4 text-zinc-600 stroke-2"
                                                                />
                                                                Terms and
                                                                Conditions</a
                                                            >
                                                        </MenuItem>
                                                    </div>
                                                </MenuItems>
                                            </transition>
                                        </Menu>
                                    </li>

                                    <li>
                                        <Menu
                                            as="div"
                                            class="relative inline-block text-left w-full"
                                        >
                                            <div class="w-full">
                                                <MenuButton
                                                    class="w-full group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-zinc-400 hover:bg-zinc-800 hover:text-white"
                                                >
                                                    <Cog6ToothIcon
                                                        class="h-6 w-6 shrink-0"
                                                    />
                                                    Settings
                                                </MenuButton>
                                            </div>

                                            <transition
                                                enter-active-class="transition ease-out duration-100"
                                                enter-from-class="transform opacity-0 scale-95"
                                                enter-to-class="transform opacity-100 scale-100"
                                                leave-active-class="transition ease-in duration-75"
                                                leave-from-class="transform opacity-100 scale-100"
                                                leave-to-class="transform opacity-0 scale-95"
                                            >
                                                <MenuItems
                                                    class="absolute left-0 z-10 mb-12 bottom-0 w-52 divide-y divide-zinc-100 origin-bottom-left rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none"
                                                >
                                                    <div class="py-1">
                                                        <MenuItem
                                                            v-slot="{ active }"
                                                        >
                                                            <Link
                                                                :href="
                                                                    route(
                                                                        'account.edit'
                                                                    )
                                                                "
                                                                :class="[
                                                                    active
                                                                        ? 'bg-zinc-100 text-zinc-800'
                                                                        : 'text-zinc-700',
                                                                    'px-3 py-1 text-[13px] font-medium flex items-center',
                                                                ]"
                                                            >
                                                                <UserCircleIcon
                                                                    class="mr-2 flex-shrink-0 h-4 w-4 text-zinc-600 stroke-2"
                                                                />
                                                                Account
                                                            </Link>
                                                        </MenuItem>
                                                    </div>

                                                    <div class="py-1">
                                                        <MenuItem
                                                            v-slot="{ active }"
                                                        >
                                                            <Link
                                                                v-if="
                                                                    !selfHosted
                                                                "
                                                                :href="
                                                                    route(
                                                                        'billing.index'
                                                                    )
                                                                "
                                                                :class="[
                                                                    active
                                                                        ? 'bg-zinc-100 text-zinc-800'
                                                                        : 'text-zinc-700',
                                                                    ' px-3 py-1 text-[13px] font-medium flex items-center',
                                                                ]"
                                                            >
                                                                <CreditCardIcon
                                                                    class="mr-2 flex-shrink-0 h-4 w-4 text-zinc-600 stroke-2"
                                                                />
                                                                Billing
                                                            </Link>
                                                        </MenuItem>

                                                        <MenuItem
                                                            v-slot="{ active }"
                                                        >
                                                            <Link
                                                                :href="
                                                                    route(
                                                                        'logout'
                                                                    )
                                                                "
                                                                method="post"
                                                                as="button"
                                                                :class="[
                                                                    active
                                                                        ? 'bg-zinc-100 text-zinc-800'
                                                                        : 'text-zinc-700',
                                                                    'w-full px-3 py-1 text-[13px] font-medium flex items-center',
                                                                ]"
                                                            >
                                                                <PowerIcon
                                                                    class="mr-2 flex-shrink-0 h-4 w-4 text-zinc-600 stroke-2"
                                                                />

                                                                Logout
                                                            </Link>
                                                        </MenuItem>
                                                    </div>
                                                </MenuItems>
                                            </transition>
                                        </Menu>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </DialogPanel>
                </TransitionChild>
            </div>
        </Dialog>
    </TransitionRoot>

    <!-- Static sidebar for desktop -->
    <div
        class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col"
    >
        <div
            class="flex grow flex-col gap-y-5 overflow-y-auto bg-zinc-800 px-6 pb-4"
        >
            <div class="flex h-16 shrink-0 items-center">
                <ApplicationLogo class="h-8 w-auto" />
            </div>
            <nav class="flex flex-1 flex-col">
                <ul role="list" class="flex flex-1 flex-col gap-y-8">
                    <li>
                        <ul role="list" class="-mx-2 space-y-1">
                            <li v-for="item in navigation" :key="item.name">
                                <Link
                                    :href="item.href"
                                    :class="[
                                        item.current
                                            ? 'bg-zinc-900 text-white'
                                            : 'text-zinc-400 hover:text-white hover:bg-zinc-900',
                                        'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold',
                                    ]"
                                >
                                    <component
                                        :is="item.icon"
                                        class="h-6 w-6 shrink-0"
                                        aria-hidden="true"
                                    />
                                    {{ item.name }}
                                </Link>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <Link
                            :href="route('websites.create')"
                            class="-mx-2 mb-2 text-white bg-blue-600 rounded-md px-4 py-2 flex text-sm"
                        >
                            New Website
                        </Link>
                        <div
                            class="text-xs font-semibold leading-6 text-zinc-400"
                        >
                            Your websites
                        </div>
                        <ul role="list" class="-mx-2 space-y-1">
                            <li v-for="website in websites" :key="website.name">
                                <Link
                                    :href="website.href"
                                    :class="[
                                        website.current
                                            ? 'bg-zinc-900 text-white'
                                            : 'text-zinc-400 hover:text-white hover:bg-zinc-900 hover:bg-opacity-50',
                                        'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold',
                                    ]"
                                >
                                    <span
                                        class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border border-zinc-700 bg-zinc-800 text-[0.625rem] font-medium text-zinc-400 group-hover:text-white"
                                        >{{ website.initial }}</span
                                    >
                                    <span class="truncate">{{
                                        website.name
                                    }}</span>
                                </Link>
                            </li>
                        </ul>
                    </li>
                    <ul class="mt-auto">
                        <li class="mt-auto">
                            <div
                                v-if="!selfHosted && user.plan.name == 'trial'"
                                @click.prevent="openModalUpgrade"
                                class="group w-full cursor-pointer -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-bold leading-6 hover:bg-zinc-800 text-fuchsia-500 hover:text-fuchsia-600"
                            >
                                <BoltIcon
                                    class="h-6 w-6 shrink-0 troke-2"
                                    aria-hidden="true"
                                />
                                Upgrade
                            </div>
                        </li>

                        <li>
                            <Menu
                                as="div"
                                class="relative inline-block text-left w-full"
                            >
                                <div class="w-full">
                                    <MenuButton
                                        class="w-full group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-zinc-400 hover:bg-zinc-800 hover:text-white"
                                    >
                                        <QuestionMarkCircleIcon
                                            class="h-6 w-6 shrink-0 stroke-2"
                                        />
                                        Help & Support
                                    </MenuButton>
                                </div>

                                <transition
                                    enter-active-class="transition ease-out duration-100"
                                    enter-from-class="transform opacity-0 scale-95"
                                    enter-to-class="transform opacity-100 scale-100"
                                    leave-active-class="transition ease-in duration-75"
                                    leave-from-class="transform opacity-100 scale-100"
                                    leave-to-class="transform opacity-0 scale-95"
                                >
                                    <MenuItems
                                        class="absolute left-0 z-10 mb-12 bottom-0 w-52 divide-y divide-zinc-100 origin-bottom-left rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    >
                                        <div class="py-1">
                                            <MenuItem v-slot="{ active }">
                                                <a
                                                    href="https://docs.wanalytics.io"
                                                    target="_blank"
                                                    :class="[
                                                        active
                                                            ? 'bg-zinc-100 text-zinc-800'
                                                            : 'text-zinc-700',
                                                        'px-3 py-1 text-[13px] font-medium flex items-center',
                                                    ]"
                                                >
                                                    <BookOpenIcon
                                                        class="mr-2 flex-shrink-0 h-4 w-4 text-zinc-600 stroke-2"
                                                    />
                                                    Documentation</a
                                                >
                                            </MenuItem>

                                            <MenuItem v-slot="{ active }">
                                                <a
                                                    href="#"
                                                    :class="[
                                                        active
                                                            ? 'bg-zinc-100 text-zinc-800'
                                                            : 'text-zinc-700',
                                                        'px-3 py-1 text-[13px] font-medium flex items-center',
                                                    ]"
                                                >
                                                    <ChatBubbleOvalLeftEllipsisIcon
                                                        class="mr-2 flex-shrink-0 h-4 w-4 text-zinc-600 stroke-2"
                                                    />
                                                    Live Support</a
                                                >
                                            </MenuItem>
                                            <MenuItem v-slot="{ active }">
                                                <a
                                                    href="https://feedback.changelogfy.com/feature-requests"
                                                    target="_blank"
                                                    :class="[
                                                        active
                                                            ? 'bg-zinc-100 text-zinc-800'
                                                            : 'text-zinc-700',
                                                        ' px-3 py-1 text-[13px] font-medium flex items-center',
                                                    ]"
                                                >
                                                    <LightBulbIcon
                                                        class="mr-2 flex-shrink-0 h-4 w-4 text-zinc-600 stroke-2"
                                                    />
                                                    Give us feedback</a
                                                >
                                            </MenuItem>
                                        </div>
                                        <div class="py-1">
                                            <MenuItem v-slot="{ active }">
                                                <a
                                                    href="https://status.changelogfy.com"
                                                    target="_blank"
                                                    :class="[
                                                        active
                                                            ? 'bg-zinc-100 text-zinc-800'
                                                            : 'text-zinc-700',
                                                        ' px-3 py-1 text-[13px] font-medium flex items-center',
                                                    ]"
                                                >
                                                    <img
                                                        src="https://status.changelogfy.com/includes/badge/?healthy=07c707"
                                                        alt=""
                                                        class="mr-2 flex-shrink-0 h-3 w-3 rounded-full"
                                                    />

                                                    System Status</a
                                                >
                                            </MenuItem>

                                            <MenuItem v-slot="{ active }">
                                                <a
                                                    href="https://feedback.changelogfy.com"
                                                    target="_blank"
                                                    :class="[
                                                        active
                                                            ? 'bg-zinc-100 text-zinc-800'
                                                            : 'text-zinc-700',
                                                        ' px-3 py-1 text-[13px] font-medium flex items-center',
                                                    ]"
                                                >
                                                    <TruckIcon
                                                        class="mr-2 flex-shrink-0 h-4 w-4 text-zinc-600 stroke-2"
                                                    />
                                                    Product Roadmap</a
                                                >
                                            </MenuItem>
                                        </div>

                                        <div class="py-1">
                                            <MenuItem v-slot="{ active }">
                                                <a
                                                    href="https://changelogfy.com/privacy"
                                                    target="_blank"
                                                    :class="[
                                                        active
                                                            ? 'bg-zinc-100 text-zinc-800'
                                                            : 'text-zinc-700',
                                                        ' px-3 py-1 text-[13px] font-medium flex items-center',
                                                    ]"
                                                >
                                                    <ShieldCheckIcon
                                                        class="mr-2 flex-shrink-0 h-4 w-4 text-zinc-600 stroke-2"
                                                    />
                                                    Privacy Policy</a
                                                >
                                            </MenuItem>

                                            <MenuItem v-slot="{ active }">
                                                <a
                                                    href="https://changelogfy.com/terms"
                                                    target="_blank"
                                                    :class="[
                                                        active
                                                            ? 'bg-zinc-100 text-zinc-800'
                                                            : 'text-zinc-700',
                                                        ' px-3 py-1 text-[13px] font-medium flex items-center',
                                                    ]"
                                                >
                                                    <BookmarkSquareIcon
                                                        class="mr-2 flex-shrink-0 h-4 w-4 text-zinc-600 stroke-2"
                                                    />
                                                    Terms and Conditions</a
                                                >
                                            </MenuItem>
                                        </div>
                                    </MenuItems>
                                </transition>
                            </Menu>
                        </li>

                        <li>
                            <Menu
                                as="div"
                                class="relative inline-block text-left w-full"
                            >
                                <div class="w-full">
                                    <MenuButton
                                        class="w-full group -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-zinc-400 hover:bg-zinc-800 hover:text-white"
                                    >
                                        <Cog6ToothIcon
                                            class="h-6 w-6 shrink-0"
                                        />
                                        Settings
                                    </MenuButton>
                                </div>

                                <transition
                                    enter-active-class="transition ease-out duration-100"
                                    enter-from-class="transform opacity-0 scale-95"
                                    enter-to-class="transform opacity-100 scale-100"
                                    leave-active-class="transition ease-in duration-75"
                                    leave-from-class="transform opacity-100 scale-100"
                                    leave-to-class="transform opacity-0 scale-95"
                                >
                                    <MenuItems
                                        class="absolute left-0 z-10 mb-12 bottom-0 w-52 divide-y divide-zinc-100 origin-bottom-left rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    >
                                        <div class="py-1">
                                            <MenuItem v-slot="{ active }">
                                                <Link
                                                    :href="
                                                        route('account.edit')
                                                    "
                                                    :class="[
                                                        active
                                                            ? 'bg-zinc-100 text-zinc-800'
                                                            : 'text-zinc-700',
                                                        'px-3 py-1 text-[13px] font-medium flex items-center',
                                                    ]"
                                                >
                                                    <UserCircleIcon
                                                        class="mr-2 flex-shrink-0 h-4 w-4 text-zinc-600 stroke-2"
                                                    />
                                                    Account
                                                </Link>
                                            </MenuItem>
                                        </div>

                                        <div class="py-1">
                                            <MenuItem v-slot="{ active }">
                                                <Link
                                                    v-if="!selfHosted"
                                                    :href="
                                                        route('billing.index')
                                                    "
                                                    :class="[
                                                        active
                                                            ? 'bg-zinc-100 text-zinc-800'
                                                            : 'text-zinc-700',
                                                        ' px-3 py-1 text-[13px] font-medium flex items-center',
                                                    ]"
                                                >
                                                    <CreditCardIcon
                                                        class="mr-2 flex-shrink-0 h-4 w-4 text-zinc-600 stroke-2"
                                                    />
                                                    Billing
                                                </Link>
                                            </MenuItem>

                                            <MenuItem v-slot="{ active }">
                                                <Link
                                                    :href="route('logout')"
                                                    method="post"
                                                    as="button"
                                                    :class="[
                                                        active
                                                            ? 'bg-zinc-100 text-zinc-800'
                                                            : 'text-zinc-700',
                                                        'w-full px-3 py-1 text-[13px] font-medium flex items-center',
                                                    ]"
                                                >
                                                    <PowerIcon
                                                        class="mr-2 flex-shrink-0 h-4 w-4 text-zinc-600 stroke-2"
                                                    />

                                                    Logout
                                                </Link>
                                            </MenuItem>
                                        </div>
                                    </MenuItems>
                                </transition>
                            </Menu>
                        </li>
                    </ul>
                </ul>
            </nav>
        </div>
    </div>

    <div
        class="sticky top-0 z-40 flex items-center gap-x-6 bg-zinc-900 px-4 py-4 shadow-sm sm:px-6 lg:hidden"
    >
        <button
            type="button"
            class="-m-2.5 p-2.5 text-zinc-400 lg:hidden"
            @click="sidebarOpen = true"
        >
            <span class="sr-only">Open sidebar</span>
            <Bars3Icon class="h-6 w-6" aria-hidden="true" />
        </button>
        <div class="flex-1 text-sm font-semibold leading-6 text-white">
            Dashboard
        </div>
        <a href="#">
            <span class="sr-only">Your profile</span>
            <img
                class="h-8 w-8 rounded-full bg-zinc-800"
                src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                alt=""
            />
        </a>
    </div>

    <ModalUpgrade ref="modalUpgrade" />
</template>
