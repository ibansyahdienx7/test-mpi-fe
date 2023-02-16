import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    server: {
        port: 3000,
        open: "/",
        changeOrigin: true,
        cors: true,
        origin: "http://127.0.0.1:3000",
    },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
            port: 8000,
            open: "/",
            changeOrigin: true,
            cors: true,
            origin: "http://127.0.0.1:8000",
        }),
    ],
});
