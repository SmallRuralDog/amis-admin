<template>
    <div class="amis-page" v-loading="loading">
        <transition name="slide-up" mode="out-in">
            <AMisRenderer :key="route.path" :amis-json="pageJson" v-if="pageJson"/>
        </transition>
    </div>
</template>

<script setup lang="ts">
import {useRoute} from "vue-router";
import {onMounted, ref, watch} from "vue";
import {useGetPageJson} from "@/utils/api";

import AMisRenderer from "@/components/amis/AMisRenderer.vue";

const pageJson = ref()

const route = useRoute()

const loading = ref(true)

watch(() => route.path, async (path: string) => {
    await getPageJson(path)
})

onMounted(() => {
    getPageJson(route.path)
})

const getPageJson = async (path: string) => {
    loading.value = true
    const res = await useGetPageJson(path)
    pageJson.value = res.data
    loading.value = false
}
</script>
<style lang="scss">

</style>
