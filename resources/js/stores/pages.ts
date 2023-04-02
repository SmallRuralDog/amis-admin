import {defineStore} from "pinia";
import {computed, reactive, ref, getCurrentInstance} from "vue";
import {useGetPageJson} from "@/utils/api";

interface pageList {
    [key: string]: any
}


export const usePagesStore = defineStore("pages", () => {

    let pages: pageList = {}

    const thisPage = reactive({
        loading: true,
        error: false,
        errorMessage: "",
        pageJson: null as any,
        showMenu: true,
        showHeader: true,
    })


    const internalInstance = getCurrentInstance();


    const getPageJson = async (path: string) => {
        try {
            internalInstance?.appContext.config.globalProperties.$Progress.start();
            thisPage.loading = true
            /*if (pages[path]) {
                thisPage.pageJson = pages[path]
                thisPage.loading = false
                return
            }*/
            const res = await useGetPageJson(path)

            if (res.action) {
                if (res.action == 'jump' && res.url) {
                    window.location.href = res.url
                }
                if (res.action == "renderPage") {
                    thisPage.showHeader = res.showHeader ?? true
                    thisPage.showMenu = res.showMenu ?? true
                }
            } else {
                thisPage.showHeader = true
                thisPage.showMenu = true
            }


            pages[path] = res.data
            thisPage.pageJson = pages[path]
            thisPage.error = false
            thisPage.loading = false
            internalInstance?.appContext.config.globalProperties.$Progress.finish();
        } catch (e) {
            console.log(e)
            thisPage.error = true
            thisPage.loading = false
            // @ts-ignore
            thisPage.errorMessage = e.message
            internalInstance?.appContext.config.globalProperties.$Progress.fail();
        }
    }

    return {
        thisPage,
        getPageJson
    }

})
