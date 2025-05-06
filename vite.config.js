import { defineConfig } from 'vite';

export default defineConfig({
  publicDir: false,
  build: {
    manifest: true,
    outDir: 'public/build',
    assetsDir: '.', // ✅ prevents .vite/ directory nesting
    rollupOptions: {
      input: 'resources/js/app.js', // 🔁 adjust if different
    },
    emptyOutDir: true,
  },
});


