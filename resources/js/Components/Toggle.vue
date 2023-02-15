<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <SwitchGroup as="div" class="flex items-center">
        <Switch
            :value="value"
            v-model="proxyChecked"
            :class="[
                proxyChecked ? 'bg-blue-500' : 'bg-zinc-200',
                'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500',
            ]"
        >
            <span
                aria-hidden="true"
                :class="[
                    proxyChecked ? 'translate-x-5' : 'translate-x-0',
                    'pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200',
                ]"
            />
        </Switch>
        <SwitchLabel as="span" class="ml-2">
            <span class="text-sm font-medium text-zinc-800 dark:text-white">{{
                label
            }}</span>
        </SwitchLabel>
    </SwitchGroup>
    <div class="text-zinc-500 mt-2 text-xs">
        {{ description }}
    </div>
</template>

<script>
import {
    Switch,
    SwitchGroup,
    SwitchLabel,
    SwitchDescription,
} from "@headlessui/vue";

export default {
    emits: ["update:checked"],

    props: {
        checked: {
            type: [Array, Boolean],
            default: false,
        },
        value: {
            default: null,
        },

        label: {
            default: null,
        },
        description: {
            default: null,
        },
    },
    components: {
        Switch,
        SwitchGroup,
        SwitchLabel,
        SwitchDescription,
    },

    computed: {
        proxyChecked: {
            get() {
                return this.checked;
            },

            set(val) {
                this.$emit("update:checked", val);
            },
        },
    },
};
</script>
