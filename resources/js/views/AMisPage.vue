<template>
    <div class="amis-page" v-loading="thisPage.loading">
        <transition name="slide-up" mode="out-in">
            <AMisRenderer :key="route.path" :amis-json="thisPage.pageJson" v-if="thisPage.pageJson"/>
        </transition>
    </div>
</template>

<script setup lang="ts">
import {useRoute} from "vue-router";
import {onMounted, ref, watch} from "vue";
import {useGetPageJson} from "@/utils/api";

import AMisRenderer from "@/components/amis/AMisRenderer.vue";
import {storeToRefs} from "pinia";
import {usePagesStore} from "@/stores/pages";

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
