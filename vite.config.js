import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
  plugins: [vue()],
  server: {
    proxy: {
      '/': 'http://localhost:8000',
    },
  },
  build: {
    rollupOptions: {
      input: {
        main: 'path/to/your/entry/point.js', // Replace this with the path to your entry point
      },
    },
  },
});