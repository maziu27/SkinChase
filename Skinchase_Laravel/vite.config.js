import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',  // o la ruta de tu CSS principal
        'resources/js/app.js',    // o la ruta de tu JS principal
      ],
      refresh: true,
    }),
  ],
});