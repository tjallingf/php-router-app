import { defineConfig } from 'vite';
import path from 'path';
import config from '../app_config.json';
import react from '@vitejs/plugin-react';
import legacy from '@vitejs/plugin-legacy'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    react(), 
    // legacy({
    //   targets: ['defaults', 'not IE 11']
    // })
  ],
  root: path.resolve('../', config.vite.rootDir),
  build: {
    outDir: config.vite.outDir,
    assetsDir: './',
    emptyOutDir: true,
    rollupOptions: {
      input: path.join(path.resolve('../', config.vite.rootDir), config.vite.inputFile),
    },
  },
  server: {
    strictPort: true,
    port: config.vite.port
  }
})
