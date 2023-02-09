import {fileURLToPath, URL} from 'url'

import {defineConfig} from 'vite'
import vue from '@vitejs/plugin-vue'
// @ts-ignore
import ElementPlus from 'unplugin-element-plus/vite'

export default defineConfig(({command, mode}) => {
    return {
        plugins: [
            vue(),
            ElementPlus(),
        ],
        resolve: {
            alias: {
                '@': fileURLToPath(new URL('./resources/js', import.meta.url))
            }
        },
        server: {
            host: '0.0.0.0',
            port: 3600
        },
        base: command == "build" ? "/vendor/admin/" : "/",
        build: {
            manifest: true,
            outDir: "./resources/dist",
            rollupOptions: {
                input: "resources/js/main.ts",
            }
        }
    }
})
