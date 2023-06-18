import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

import VueTippy from "vue-tippy";

// locales
import { createI18n } from "vue-i18n";
import localeMessages from "./vue-i18n-locales.generated";

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "wAnalytics";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
         const i18n = createI18n({
             locale: props.initialPage.props.locale
                 ? props.initialPage.props.locale
                 : "en",
             fallbackLocale: "en", // set fallback locale
             messages: localeMessages, // set locale messages
         });

        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(i18n)
            .use(VueTippy)
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
