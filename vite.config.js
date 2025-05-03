import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/demo/styles.css',
                'resources/js/app.js',
                'resources/js/demo/scripts.js',
                'resources/js/demo/chart-area-demo.js',
                'resources/js/demo/chart-bar-demo.js',
                'resources/js/demo/chart-pie-demo.js',
                'resources/js/demo/datatables-simple-demo.js',
                'resources/js/demo/datatables-demo.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
