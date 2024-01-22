<template>
  <el-container>
    <template v-if="thisPage.showMenu">
      <el-aside
        v-if="!menuInfo.isMobile"
        :width="menuInfo.isCollapse ? '64px' : '180px'"
        class="transition-all"
        :style="{ backgroundColor: config.menu?.backgroundColor ?? `#111827` }"
      >
        <Aside />
      </el-aside>
      <el-drawer
        v-else
        v-model="menuInfo.isSlider"
        direction="ltr"
        :with-header="false"
        :size="180"
      >
        <Aside />
      </el-drawer>
    </template>
    <el-main>
      <el-container>
        <template v-if="thisPage.showHeader">
          <el-header class="">
            <Header />
          </el-header>
        </template>
        <el-main class="main-content">
          <el-scrollbar>
            <router-view />
          </el-scrollbar>
        </el-main>
      </el-container>
    </el-main>
  </el-container>
</template>

<script setup lang="ts">
const { menuInfo } = useMenuStore();
const { config } = useAmisAdminStore();
const { thisPage } = storeToRefs(usePagesStore());
const { width } = useWindowSize();
const initPage = () => {
  const screenWidth = width.value;
  if (screenWidth < 768) {
    menuInfo.isMobile = true;
    menuInfo.isSlider = false;
    menuInfo.isCollapse = true;
  } else if (screenWidth >= 768 && screenWidth < 1280) {
    menuInfo.isMobile = false;
    menuInfo.isCollapse = true;
  } else {
    menuInfo.isMobile = false;
    menuInfo.isCollapse = false;
  }
};
initPage();
watch(width, (w) => {
  initPage();
});
</script>
<style lang="scss">
.slide-up-leave-active {
  transition: all 0.3s;
}

.slide-up-enter-active {
  transition: all 0.3s;
}

.slide-up-enter-from,
.slide-up-leave-to {
  transform: translate(0, 5px);
  opacity: 0;
}
</style>
