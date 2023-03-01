import './bootstrap';
import '../css/app.css';
import 'flowbite';

import { createApp, h } from 'vue';
import { createInertiaApp, Head, Link } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import axios from 'axios';
import VueCharts from 'vue3-apexcharts';
import VueApexCharts from 'vue3-apexcharts';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(VueApexCharts)
            .component('Link', Link)
            .component('axios', axios)
            .component('Head', Head)
            .mount(el);
    },
    title: title => `BoolBnB - ${title}`,
    progress: {
        color: '#4d1635',
        showSpinner: true
    },
});


// Grazie Classe#75, 31/08/2022 - 02/03/2023. Questo é solo l'inizio per tutti noi, AUGURI!
