import { defineConfig } from 'vite';
import path from 'path';
import config from './app_config.json';
import react from '@vitejs/plugin-react';
import legacy from '@vitejs/plugin-legacy'

const rootDir = path.resolve(config.client.rootDir);
const srcDir  = path.join(rootDir, config.client.srcDir);
const outDir  = path.resolve(rootDir, config.client.outDir);

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
