import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
  plugins: [
    laravel({
      input: ["resources/app.css", "resources/app.js"],
      refresh: true,
    }),
    tailwindcss()
  ],
  server: {
    host: "0.0.0.0",
    hmr: {
      host: "localhost",
    },
    cors: {
      origin: "http://stagerightlabs.test",
      methods: "GET,HEAD,PUT,PATCH,POST,DELETE",
      preflightContinue: false,
      optionsSuccessStatus: 204,
    },
  },
});
