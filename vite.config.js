import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

import visualizer from 'rollup-plugin-visualizer';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        visualizer({ open: true }),
    ],
    build: {
        chunkSizeWarningLimit:1000,
        rollupOptions: {
            output: {
                manualChunks(id) {
                    if (id.includes('node_modules/@onfido/active-video-capture')){
                        return 'onfido-active-video-capture';
                    }

                    if (id.includes('node_modules/@onfido')){
                        return 'onfido';
                    }

                    if (id.includes('node_modules/onfido-sdk-ui')){
                        return 'onfido-sdk-ui';
                    }
                },
            },
        },
    },
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
});
