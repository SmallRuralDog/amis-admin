import { fileURLToPath, URL } from "url";
import UnoCSS from "unocss/vite";

import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";

import autoImport from "unplugin-auto-import/vite";
import components from "unplugin-vue-components/vite";
import { ElementPlusResolver } from "unplugin-vue-components/resolvers";

export default defineConfig(({ command, mode }) => {
  return {
    plugins: [
      vue(),
      UnoCSS(),
      components({
        dirs: ["resources/js/components"],
        resolvers: [ElementPlusResolver()],
        dts: "./resources/js/components.d.ts",
      }),
      autoImport({
        imports: [
          "vue",
          "pinia",
          {
            "vue-router": [
              "useLink",
              "useRoute",
              "useRouter",
              "onBeforeRouteLeave",
              "createRouter",
              "createWebHistory",
            ],
            "@vueuse/core": [
              "useStorage", //存储
              "useLocalStorage", //本地存储
              "useUrlSearchParams", //url 参数
              "useAsyncState", //异步状态
              "useBrowserLocation", //浏览器位置
              "useScriptTag", //动态加载 js
              "useFileDialog", //文件选择
              "useInfiniteScroll", //无限滚动
              "useDevicePixelRatio", //设备像素比
              "useIntervalFn", //定时器
              "useTimestamp", //时间戳
              "useWebSocket", //websocket
              "onClickOutside", //Listen for clicks outside of an element. Useful for modal or dropdown. 监听元素外的点击。对于模态或下拉很有用。
              "useVirtualList", //虚拟列表
              "useNetwork", //网络状态
              "useThrottleFn", //函数执行节流
              "useCycleList", //循环浏览项目列表。
              "refThrottled", //ref 值节流
              "refDebounced", //ref 值防抖
              "watchThrottled", //watch 节流
              "watchDebounced", //watch 防抖
              "refAutoReset", //A ref which will be reset to the default value after some time. 一段时间后将重置为默认值的 ref。
              "useMounted", //组件是否挂载
              "useScroll", //Reactive scroll position and state. 可响应的滚动位置和状态。
              "onLongPress", //Listen for a long press on an element. 监听元素的长按事件。
              "useElementVisibility", //元素是否可见
              "useDraggable", //拖拽
              "useDocumentVisibility", //文档是否可见
              "useWebWorkerFn", //使用简单的语法，在不阻塞 UI 的情况下运行昂贵的函数，该语法利用了 Promise。
              "useWakeLock", //使用 WakeLock API 防止设备进入睡眠模式。
              "useWindowSize", //窗口大小
            ],
            vooks: ["useMemo", "useBreakpoint"],
          },
        ],
        resolvers: [ElementPlusResolver({})],
        dts: "./resources/js/auto-imports.d.ts",
        dirs: [
          "resources/js/router",
          "resources/js/stores",
          "resources/js/utils",
        ],
      }),
    ],
    resolve: {
      alias: {
        "@": fileURLToPath(new URL("./resources/js", import.meta.url)),
      },
    },
    css: {
      preprocessorOptions: {
        scss: {
          additionalData: `@import "./resources/js/style/main.scss";`,
        },
      },
    },
    server: {
      host: "0.0.0.0",
      port: 3600,
    },
    base: command == "build" ? "/vendor/admin/" : "/",
    build: {
      manifest: true,
      outDir: "./resources/dist",
      rollupOptions: {
        input: "resources/js/main.ts",
      },
    },
  };
});
