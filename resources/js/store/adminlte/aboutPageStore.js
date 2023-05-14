import {defineStore} from 'pinia'

export const adminAboutPageStore = defineStore('aboutPageStore', {
    state: () => ({
        firstSectionData: {
            authorName: '',
            authorDescription: '',
            description: '',
            image: '',
        },
        secondSectionData: {
            title: '',
            description: '',
            image: '',
        },
        thirdSectionData: {
            title: '',
            description: '',
        }

    }),
    getters: {
        getFirstSectionData: state => {
            return state.firstSectionData
        },
        getSecondSectionData: state => {
            return state.secondSectionData
        },
        getThirdSectionData: state => {
            return state.thirdSectionData
        },
    },
    actions: {
        setFirstSectionDataAuthorName(value){
            this.firstSectionData.authorName = value
        },
        setFirstSectionDataAuthorDescription(value){
            this.firstSectionData.authorDescription = value
        },
        setFirstSectionDataDescription(value){
            this.firstSectionData.description = value
        },
        setFirstSectionDataImage(file){
            this.firstSectionData.image = file
        },

        setSecondSectionDataTitle(value){
            this.secondSectionData.title = value
        },
        setSecondSectionDataDescription(value){
            this.secondSectionData.description = value
        },
        setSecondSectionDataImage(file){
            this.secondSectionData.image = file
        },

        setThirdSectionDataTitle(value){
            this.thirdSectionData.title = value
        },
        setThirdSectionDataDescription(value){
            this.thirdSectionData.description = value
        }
    }

})
