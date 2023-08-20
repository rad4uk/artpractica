import { defineStore } from 'pinia'
export const useProjectStore = defineStore('projectStore', {
    state: () => {
        return {
            contentImagesSliderData: [],
        }
    },
    getters: {
        getContentImagesSliderData: state => {
            return state.contentImagesSliderData
        },

    },
    actions: {
        setContentImagesSliderData(images){
            this.contentImagesSliderData = images
        },
    }
})
