import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import PrimeVue from 'primevue/config';
import ToastService from "primevue/toastservice";
/*
import en from './Locales/en.json';
*/
import ru from '../lang/ru.json';
import { createI18n } from 'vue-i18n';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

const i18n = createI18n({
    locale: 'ru',
    messages: {
        ru: ru,
    }
});

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(PrimeVue)
            .use(i18n)
            .use(ToastService)
            .mixin({ methods: { route } })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
