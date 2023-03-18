import { defineConfig } from 'vite';
import path from 'path';
import config from './app_config.json';
import react from '@vitejs/plugin-react';
import legacy from '@vitejs/plugin-legacy'
import liveReload from 'vite-plugin-live-reload'

const outDir = path.resolve(config.vite.outDir);
const srcDir = path.resolve(config.vite.srcDir);

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    react(), 
    legacy({
      targets: ['defaults', 'not IE 11']
    }),
    // liveReload([
    //   path.join(srcDir, '/**/*.*')
    // ])
  ],
  root: srcDir,
  build: {
    manifest: true,
    outDir: outDir,
    assetsDir: './',
    emptyOutDir: true,
    rollupOptions: {
      input: path.join(srcDir, config.vite.input || 'main.jsx')
    }
  },
  server: {
    cors: true,
    strictPort: true,
    port: config.vite.devPort || 5173
  },
  resolve: {
    alias: {
      '@': srcDir
    }
  }
})
