import { defineStore } from 'pinia'
export const designStore = defineStore('designStore', {
    state: () => {
        return {
            currentImage: Object,
        }
    },
    getters: {
        getContentActive: state => {
            return state.isContentActive
        },

    },
    actions: {

        setCategories(categories){
            this.categories = categories
        },

    }
})
