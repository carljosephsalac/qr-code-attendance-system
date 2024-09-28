import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    server: {
        host: "0.0.0.0", // Listen on all available network interfaces
        hmr: {
            host: "192.168.0.107", // Replace with your computer's local IP
        },
    },
});
