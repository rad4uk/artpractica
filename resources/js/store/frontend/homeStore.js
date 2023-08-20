import { defineStore } from 'pinia'
export const homeStore = defineStore('homeStore', {
    state: () => {
        return {
            isOpenConsultationPopup: false,
        }
    },
    getters: {
        getIsOpenConsultationPopup: state => {
            return state.isOpenConsultationPopup
        },

    },
    actions: {
        openConsultationPopup(){
            this.isOpenConsultationPopup = true
        },
        closeConsultationPopup(){
            this.isOpenConsultationPopup = false
        },
    }
})
