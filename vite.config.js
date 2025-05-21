import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from 'tailwindcss';
export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],server: {
        host: '192.168.0.107', 
        port: 5173, 
        strictPort: true,
        hmr: false,
    },
    css: {
        postcss: {
          plugins: [tailwindcss()],
        },
    }
});
