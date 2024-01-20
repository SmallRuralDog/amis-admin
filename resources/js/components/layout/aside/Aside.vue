<template>
  <div class="main-logo">
    <div class="truncate" v-if="!menuInfo.isCollapse">{{ config.name }}</div>
  </div>
  <el-scrollbar class="main-menu-scrollbar">
    <el-menu
      v-if="menuInfo.menuData.length > 0"
      background-color="#111827"
      text-color="#ffffff"
      active-text-color="#409eff"
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
