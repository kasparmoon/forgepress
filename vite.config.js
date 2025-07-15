import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';

// https://vitejs.dev/config/
export default defineConfig({
	plugins: [
		react()
	],
	// This new 'esbuild' section explicitly tells Vite how to handle .jsx files.
	esbuild: {
		loader: 'jsx',
		include: /src\/.*\.jsx?$/,
		exclude: [],
	},
	server: {
		// This allows your WordPress site to request files from the Vite server.
		cors: true,
		hmr: {
			host: 'localhost',
		},
	},
	build: {
		// generate manifest.json in outDir
		manifest: true,
		rollupOptions: {
			// overwrite default .html entry
			input: 'src/main.jsx',
		},
		outDir: 'dist'
	}
});