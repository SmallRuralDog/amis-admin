import {defineStore} from "pinia";
import {computed, reactive, ref} from "vue";

export const useAmisAdminStore = defineStore("admin", () => {
    const config = ref<AmisAdmin>(window.AmisAdmin)
    return {
        config
    }
})
