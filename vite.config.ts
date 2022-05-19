import {fileURLToPath, URL} from 'url'

import {defineConfig, loadEnv} from 'vite'
import vue from '@vitejs/plugin-vue'
import AutoImport from 'unplugin-auto-import/vite'
import Components from 'unplugin-vue-components/vite'
import {ElementPlusResolver} from 'unplugin-vue-components/resolvers'

export default defineConfig(({command, mode}) => {
    return {
        plugins: [
            vue(),
            AutoImport({
                resolvers: [ElementPlusResolver()],
            }),
            Components({
                resolvers: [ElementPlusResolver()],
            }),
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
