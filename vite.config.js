import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

const host = 'localhost';

export default defineConfig({
    server: {
        hmr: {
            host: host,
        },
    },
    resolve: {
        alias: {
            '~bootstrap': '/node_modules/bootstrap',
        }
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        manifest: 'manifest.json', // Customize the manifest filename...
    },
});
