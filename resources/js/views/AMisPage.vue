<template>
    <div class="amis-page">
        <transition name="slide-up" mode="out-in">
            <AMisRenderer :key="route.path" :amis-json="thisPage.pageJson" v-if="!thisPage.error && thisPage.pageJson"/>
        </transition>
        <div v-if="thisPage.error && !thisPage.loading">
            <el-alert :closable="false" type="error" show-icon>{{ thisPage.errorMessage }}</el-alert>
        </div>
    </div>
</template>

<script setup lang="ts">
import {useRoute} from "vue-router";
import {onMounted, watch} from "vue";

import AMisRenderer from "@/components/amis/AMisRenderer.vue";
import {storeToRefs} from "pinia";
import {usePagesStore} from "@/stores/pages";
import ErrorPage from "@/views/ErrorPage.vue";

const {thisPage} = storeToRefs(usePagesStore())
const {getPageJson} = usePagesStore()
const route = useRoute()

watch(() => route.path, async (path: string) => {
    await getPageJson(path)
})

onMounted(async () => {
    await getPageJson(route.path)
})
</script>
<style lang="scss">
</style>
