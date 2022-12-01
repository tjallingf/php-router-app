import { defineConfig } from 'vite';
import { resolve } from 'path';
import config from '../app.json';
import react from '@vitejs/plugin-react';

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [react()],
  root: resolve('../', config.vite.rootDir),
  build: {
    outDir: config.vite.outDir,
    assetsDir: './',
    emptyOutDir: true,
    rollupOptions: {
      input: config.vite.inputFile,
    }
  },
  server: {
    strictPort: true,
    port: config.vite.port
  }
})
