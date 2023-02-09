import { defineConfig } from 'vite';
import path from 'path';
import config from './app_config.json';
import react from '@vitejs/plugin-react';
import legacy from '@vitejs/plugin-legacy'

const outDir = path.resolve(config.client.outDir);
const srcDir = path.resolve(config.client.srcDir);

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    react(), 
    legacy({
      targets: ['defaults', 'not IE 11']
    })
  ],
  root: srcDir,
  build: {
    outDir: outDir,
    assetsDir: './',
    emptyOutDir: true,
    rollupOptions: {
      input: path.join(srcDir, config.client.inputFile),
    },
  },
  server: {
    strictPort: true,
    port: config.client.devPort
  }
})
