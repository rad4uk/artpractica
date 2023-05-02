import {defineStore} from 'pinia'

export const adminCategoryStore = defineStore('categoryStore', {
    state: () => ({
        metaData: {
            title: '',
            description: ''
        },
    }),
    getters: {
        getMetaData: state => {
            return state.metaData
        },
    },
    actions: {
        setMetaDataTitle(value){
            this.metaData.title = value
        },
        setMetaDataDescription(value){
            this.metaData.description = value
        },
    }

})
