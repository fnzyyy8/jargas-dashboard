import { createInertiaApp, router } from '@inertiajs/vue3';
import { createPinia } from 'pinia';
import { createApp, h } from 'vue';
import type { Component } from 'vue';

import AppDatePicker from '@/components/AppDatePicker.vue';
import ConfirmationDialog from '@/components/ConfirmationDialog.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import MainLayouts from '@/Layouts/MainLayouts.vue';
import { useBreadcrumbStore } from '@/stores/useBreadcrumbStore';
import vuetify from '@/vuetify';
import { ZiggyVue } from 'ziggy-js';

const appName = import.meta.env.VITE_APP_NAME || 'Jargas';

type ComponentWithLayout = Component & {
    layout?: Component;
};

void createInertiaApp({
    layout: (name, page: ComponentWithLayout) => {
        if (page.layout) {
            return page.layout;
        }

        if (name.startsWith('Auth/')) {
            return GuestLayout;
        }

        return MainLayouts;
    },
    title: (title) => (title ? `${title} - ${appName}` : appName),
    setup({ el, App, props, plugin }) {
        const pinia = createPinia();
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(vuetify)
            .use(ZiggyVue);

        app.component('AppDatePicker', AppDatePicker);
        app.component('ConfirmationDialog', ConfirmationDialog);
        app.use(pinia);

        router.on('start', () => {
            const breadcrumb = useBreadcrumbStore();
            breadcrumb.clearBreadcrumbs();
        });

        if (typeof window !== 'undefined' && el) {
            app.mount(el);
        }

        return app;
    },
    progress: {
        color: '#4B5563',
    },
});
