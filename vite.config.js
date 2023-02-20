import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import react from "@vitejs/plugin-react";

export default defineConfig({
    server: {
        proxy: "https://api.yelp.com/v3",
        port: 3000,
        open: "/",
        changeOrigin: true,
        cors: true,
        origin: "http://127.0.0.1:3000",
    },
    plugins: [
        laravel(
            {
                input: "resources/js/app.jsx",
                refresh: true,
            },
            {
                input: "resources/views/**/*.blade.php",
                refresh: true,
            }
        ),
        react(),
    ],
});
