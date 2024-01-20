import { defineStore } from "pinia";
import { computed, onMounted, reactive, ref, watch } from "vue";
import { useGetMenu } from "@/utils/api";
import { useRoute } from "vue-router";

export const useMenuStore = defineStore("menu", () => {
  const menuInfo = reactive({
    isCollapse: false,
    isMobile: false,
    isSlider: false,
    menuActive: "menus",
    menuData: [] as IMenu[],
    activeMenus: {} as { [key: string]: string[] },
  });

  const toggleCollapse = () => {
    if (menuInfo.isMobile) {
      menuInfo.isSlider = !menuInfo.isSlider;
      menuInfo.isCollapse = false;
    } else {
      menuInfo.isCollapse = !menuInfo.isCollapse;
    }
  };

  const getMenuData = async () => {
    const res = await useGetMenu();
    menuInfo.menuData = res.data.menus;
    menuInfo.activeMenus = res.data.active_menus;
    getActiveMenu(selfMenuPath.value);
  };

  onMounted(getMenuData);
  const route = useRoute();
  watch(
    () => route.path,
    (path) => {
      getActiveMenu(selfMenuPath.value);
    }
  );
  const getActiveMenu = (path: string) => {
    for (let [key, value] of Object.entries(menuInfo.activeMenus)) {
      if (value.includes(path)) {
        menuInfo.menuActive = key;
        break;
      }
    }
  };
  const selfMenuPath = computed<string>(() => {
    return route.path.replace(/^\//, "").split("/")[0];
  });
  menuInfo.menuActive = selfMenuPath.value;
  return {
    menuInfo,
    toggleCollapse,
  };
});
