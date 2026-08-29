import { createInertiaApp } from '@inertiajs/vue3';
import { createApp, h } from 'vue';
import { ZiggyVue } from 'ziggy-js';

import AppDatePicker from '@/components/AppDatePicker.vue';
import ConfirmationDialog from '@/components/ConfirmationDialog.vue';
import MainLayouts from '@/Layouts/MainLayouts.vue';
import vuetify from '@/vuetify';

const appName = import.meta.env.VITE_APP_NAME || 'Jargas';

void createInertiaApp({
    layout: () => MainLayouts,
    title: (title) => (title ? `${title} - ${appName}` : appName),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(vuetify)
            .use(ZiggyVue);

        app.component('AppDatePicker', AppDatePicker);
        app.component('ConfirmationDialog', ConfirmationDialog);

        if (typeof window !== 'undefined' && el) {
            app.mount(el);
        }

        return app;
    },
    progress: {
        color: '#4B5563',
    },
});
