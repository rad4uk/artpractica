import {defineStore} from 'pinia'

export const adminMetaDataStore = defineStore('metaDataStore', {
    state: () => ({
        metaData: {
            title: '',
            description: ''
        }
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
