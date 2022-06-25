import {defineStore} from "pinia";
import {computed, reactive, ref,getCurrentInstance} from "vue";
import {useGetPageJson} from "@/utils/api";

interface pageList {
    [key: string]: any
}


export const usePagesStore = defineStore("pages", () => {

    let pages: pageList = {}

    const thisPage = reactive({
        loading: true,
        error: false,
        pageJson: null as any,
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
            pages[path] = res.data
            thisPage.pageJson = pages[path]
            thisPage.loading = false
            internalInstance?.appContext.config.globalProperties.$Progress.finish();
        } catch (e) {
            thisPage.error = true
            thisPage.loading = false
        }
    }

    return {
        thisPage,
        getPageJson
    }

})
