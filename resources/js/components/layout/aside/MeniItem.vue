<template>
    <el-sub-menu v-if="menu.children" :index="menu.key">

        <template #title>
            <el-icon v-if="menu.icon">
                <i class="text-sm" :class="menu.icon"></i>
            </el-icon>
            <span> {{ menu.title }}</span>
        </template>
        <template v-for="i in menu.children" :key="i.title">
            <MeniItem :menu="i"/>
        </template>
    </el-sub-menu>
    <el-menu-item v-else :index="menu.key" @click="itemClick">
        <el-icon v-if="menu.icon">
            <i class="text-sm" :class="menu.icon"></i>
        </el-icon>
        <template #title>{{ menu.title }}</template>
    </el-menu-item>
</template>

<script setup lang="ts">
import {useRouter} from "vue-router";

const props = defineProps<{
    menu: IMenu
}>()

const router = useRouter()

const itemClick = () => {

    const {menu} = props

    if (menu.uri_type === 'route') {
        router.push({path: menu.uri, query: menu.params})
    } else {
        const a = document.createElement('a')
        if (menu.target) {
            a.target = menu.target
        }
        a.href = menu.uri
        a.click()
    }

}

</script>
