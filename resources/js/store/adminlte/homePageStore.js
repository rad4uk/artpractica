import {defineStore} from 'pinia'

export const adminHomePageStore = defineStore('homePageStore', {
    state: () => ({
        sliderData: {
            firstSliderData: {
                title: '',
                files: []
            },
            secondSliderData: {
                title: '',
                files: []
            },
            thirdSliderData: {
                title: '',
                files: []
            },
        },
        firstSectionData: {
            title: '',
            firstText: '',
            secondText: '',
            yearQuantity: '',
            cityQuantity: '',
            projectQuantity: ''
        },
        secondSectionData: {
            title: '',
            items: []
        },
        metaData: {
            title: '',
            description: ''
        }


    }),
    getters: {
        getSliderDataByName: state => {
            return (index) => state.sliderData[index]
        },
        getMetaData: state => {
            return state.metaData
        },
        getFirstSectionData: state => {
            return state.firstSectionData
        },
        getSecondSectionData: state => {
            return state.secondSectionData
        }

    },
    actions: {
        setMetaDataTitle(value){
            this.metaData.title = value
        },
        setSliderDataByName(sliderName, sliderData){
            this.sliderData[sliderName] = sliderData
        },
        setMetaDataDescription(value){
            this.metaData.description = value
        },
        setSliderFilesDataByName(objectName, file) {
            this.sliderData[objectName].files.push(file)
        },
        setSliderTitleDataByName(objectName, title) {
            this.sliderData[objectName].title = title
        },
        removeSliderFilesDataByIndex(objectName, index){
            this.sliderData[objectName].files.splice(index, 1)
        },

        setFirstSectionProperty(propertyName, value){
            this.firstSectionData[propertyName] = value
        },

        setSecondSectionItems(items){
            this.secondSectionData.items = items
        },
        setSecondSectionTitle(title){
            this.secondSectionData.title = title
        },

    }

})
