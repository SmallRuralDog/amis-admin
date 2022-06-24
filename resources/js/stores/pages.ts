import {defineStore} from "pinia";
import {computed, reactive, ref} from "vue";
import {useGetPageJson} from "@/utils/api";

interface pageList {
    [key: string]: any
}



export const usePagesStore = defineStore("pages", () => {

    let pages:pageList = {}

    const thisPage = reactive({
        loading: true,
        pageJson: null as any,
    })

    const getPageJson = async (path: string) => {
        thisPage.loading = true
        /*if (pages[path]) {
            thisPage.pageJson = pages[path]
            thisPage.loading = false
            return
        }*/
        const res = await useGetPageJson(path)
        pages[path] =  res.data
        thisPage.pageJson = pages[path]
        thisPage.loading = false
    }

    return {
        thisPage,
        getPageJson
    }

})
