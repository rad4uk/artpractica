import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/jetstream.css',
                'resources/js/app.js',
                'resources/js/jetstream.js',
                'resources/js/adminlte/index.js',
                'resources/js/adminlte/gallery.js',
                'resources/js/adminlte/project.js',
                'resources/js/adminlte/category.js',
                'resources/js/adminlte/page.js',


                'resources/sass/frontend/app.scss',

                'resources/sass/frontend/homepage.scss',
                'resources/js/frontend/home.js',

                'resources/sass/frontend/portfolio.scss',
                'resources/js/frontend/portfolio.js',

                'resources/sass/frontend/project.scss',
                'resources/js/frontend/project.js',

                'resources/sass/frontend/design.scss',
                'resources/js/frontend/design.js',

                'resources/sass/frontend/about.scss',
                'resources/js/frontend/about.js',

                'resources/sass/frontend/contact.scss',
            ],
            refresh: [
                ...refreshPaths,
                'app/Http/Livewire/**',
            ],
        }),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
            '@root': '/resources',
        },
    },
});
