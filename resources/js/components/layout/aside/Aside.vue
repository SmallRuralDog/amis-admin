<template>
  <div class="main-logo" :style="{backgroundColor: config.menu?.backgroundColor ?? `#111827`}">
    <div class="truncate" :style="{color:config.menu?.textColor ?? `#ffffff`}" v-if="!menuInfo.isCollapse">{{ config.name }}</div>
  </div>
  <el-scrollbar class="main-menu-scrollbar">
    <el-menu
      v-if="menuInfo.menuData.length > 0"
      :background-color="config.menu?.backgroundColor ?? `#111827`"
      :text-color="config.menu?.textColor ?? `#ffffff`"
      :active-text-color="config.menu?.activeTextColor ?? `#409eff`"
      :collapse="menuInfo.isCollapse"
      :collapse-transition="false"
      :default-active="menuInfo.menuActive"
    >
      <template v-for="menu in menuInfo.menuData" :key="menu.key">
        <MeniItem :menu="menu" />
      </template>
    </el-menu>
  </el-scrollbar>
</template>

<script setup lang="ts">
const { menuInfo } = useMenuStore();
const { config } = useAmisAdminStore();
</script>

<style lang="scss"></style>
