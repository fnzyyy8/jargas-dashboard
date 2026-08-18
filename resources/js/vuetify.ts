import '@mdi/font/css/materialdesignicons.css';
import 'vuetify/styles';

import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';

const isBrowser = typeof window !== 'undefined'
const currentTheme = isBrowser? (localStorage.getItem('theme') || 'light') : "light"
export default createVuetify({
    directives,
    theme: {
        defaultTheme: currentTheme
    },
    components: {
        ...components,
    },
});
