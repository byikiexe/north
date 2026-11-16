
import { createApp, h, type DefineComponent } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';

type PageModule = {
    default: DefineComponent;
};

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob<PageModule>('./pages/**/*.vue', {
            eager: true,
        });

        const page = pages[`./pages/${name}.vue`];

        if (!page) {
            throw new Error(`Inertia page not found: ${name}`);
        }

        return page.default;
    },

    setup({ el, App, props, plugin }) {
        createApp({
            render: () => h(App, props),
        })
            .use(plugin)
            .mount(el);
    },
});
