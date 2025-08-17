import { defineConfig } from 'vite';
import { resolve } from 'path';
import { viteStaticCopy } from 'vite-plugin-static-copy';

export default defineConfig({
  plugins: [
    viteStaticCopy({
      targets: [
        {
          src: 'assets/images/icons/**/*',
          dest: 'images/icons'
        },
        {
          src: 'assets/fonts/**/*',
          dest: 'fonts'
        },
        {
          src: 'assets/images/**/*',
          dest: 'images'
        }
      ]
    })
  ],
  build: {
    outDir: 'assets/dist',
    emptyOutDir: true,
    manifest: true,
    assetsDir: '', // Put assets in root of dist folder
    target: 'es2020', // Support modern browsers with better ES module support
    minify: 'terser',
    rollupOptions: {
      input: {
        main: resolve(__dirname, 'assets/src/js/main.js'),
        style: resolve(__dirname, 'assets/src/scss/style.scss')
      },
      output: {
        format: 'es', // ES modules format
        assetFileNames: (assetInfo) => {
          const info = assetInfo.name.split('.');
          let extType = info[info.length - 1];
          
          // Handle different asset types
          if (/\.(css)$/.test(assetInfo.name)) {
            return 'css/[name]-[hash].css';
          }
          if (/\.(png|jpe?g|gif|svg|webp|ico)$/.test(assetInfo.name)) {
            return 'images/[name]-[hash].[ext]';
          }
          if (/\.(woff2?|eot|ttf|otf)$/.test(assetInfo.name)) {
            return 'fonts/[name]-[hash].[ext]';
          }
          
          return `${extType}/[name]-[hash].${extType}`;
        },
        chunkFileNames: 'js/[name]-[hash].js',
        entryFileNames: 'js/[name]-[hash].js'
      },
      external: [],
      // Configure how imports are handled
      preserveEntrySignatures: 'strict'
    }
  },
  server: {
    hmr: {
      host: 'localhost'
    }
  },
  // Define base URL for asset resolution  
  base: './',
  // Disable public directory to prevent copying unwanted assets
  publicDir: false,
  // Resolve aliases for cleaner imports
  resolve: {
    alias: {
      '@': resolve(__dirname, 'assets/src'),
      '@images': resolve(__dirname, 'assets/images'),
      '@fonts': resolve(__dirname, 'assets/fonts')
    }
  },
  // Configure how modules are handled
  define: {
    // Replace import.meta.url with a browser-compatible alternative
    'import.meta.url': JSON.stringify(''),
    'import.meta': 'undefined'
  },
  esbuild: {
    // Configure esbuild to handle import.meta properly
    supported: {
      'import-meta': false
    }
  }
});