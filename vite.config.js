import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'public/assets/dist/css/style.css', // custom css ချိတ်ဆက်ရန် 
                'public/assets/dist/js/app.js'
            ],
            refresh: true,
        }),
    ],
});
