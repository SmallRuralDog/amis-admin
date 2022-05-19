import {defineStore} from "pinia";
import {computed, onMounted, reactive, ref, watch} from "vue";
import {useGetMenu} from "@/utils/api";
import {useRoute} from "vue-router";

export const useMenuStore = defineStore("menu", () => {
    const menuInfo = reactive({
        isCollapse: false,
        isMobile: false,
        isSlider: false,
        menuActive: "menus",
        menuData: [] as IMenu[],
    })


    const toggleCollapse = () => {
        if (menuInfo.isMobile) {
            menuInfo.isSlider = !menuInfo.isSlider
            menuInfo.isCollapse = false
        } else {
            menuInfo.isCollapse = !menuInfo.isCollapse
        }
    }

    const getMenuData = async () => {
        const res = await useGetMenu()
        menuInfo.menuData = res.data
    }

    onMounted(getMenuData)

    const route = useRoute()

    watch(() => route.path, path => {
        menuInfo.menuActive = selfMenuPath.value
    })

    const selfMenuPath = computed<string>(() => {
        return route.path.replace(/^\//, '').split('/')[0]
    })

    menuInfo.menuActive = selfMenuPath.value

    return {
        menuInfo,
        toggleCollapse,

    }
})
