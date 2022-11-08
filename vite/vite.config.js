import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'
import { readFileSync } from 'fs';
import { resolve } from 'path';

const config = JSON.parse(readFileSync(resolve(__dirname, '../storage/app/config.json')));

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [react()],
  root: 'src',
  build: {
    outDir: '../../public/dist',
    assetsDir: './',
    emptyOutDir: true,
    rollupOptions: {
      input: resolve(__dirname, 'src/main.js'),
    }
  },
  server: {
    strictPort: true,
    port: config.vite.server.port
  }
})
