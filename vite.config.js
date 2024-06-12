import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/css/admin.css',

        'resources/css/templates/1/app.css',
        'resources/js/templates/1/app.js',
      ],
      refresh: true,
    }),
  ],
})
