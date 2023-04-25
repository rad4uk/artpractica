import {defineStore} from 'pinia'

export const adminServicesStore = defineStore('servicesStore', {
    state: () => ({
        currentTemplate: null,
        metaData: {
            title: '',
            description: ''
        },
        firstTemplate: {
            name: 'firstTemplate',
            first_section_title: '',
            first_section_description: []
        },
        secondTemplate: {
            name: 'secondTemplate',
            first_section_description: [],
            second_section_title: '',
            second_section_image: null,
            second_section_description: '',
            third_section_title: '',
            third_section_description: '',
        },
        thirdTemplate: {
            name: 'thirdTemplate',

            second_section_title: '',
            second_section_description: '',
            second_section_image: null,

            first_section_description: [],

            third_section_title: '',
            third_section_description: '',
            third_section_images: [],
        },
    }),
    getters: {
        getCurrentTemplate: state => {
          return state.currentTemplate
        },
        getFirstTemplate: state => {
            return state.firstTemplate
        },
        getSecondTemplate: state => {
            return state.secondTemplate
        },
        getThirdTemplate: state => {
            return state.thirdTemplate
        },
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
        setEditPageTemplate(templateData) {
            this[templateData.name] = templateData
            this.currentTemplate = this[templateData.name]
        },


        setCurrentTemplate(template){
            this.currentTemplate = template
        },
        setFirstTemplateFirstSectionTitle(value){
            this.firstTemplate.first_section_title = value
        },
        setFirstTemplateFirstSectionDescription(data){
            this.firstTemplate.first_section_description = data
        },
        setSecondTemplateFirstSectionDescription(data){
            this.secondTemplate.first_section_description = data
        },
        setSecondTemplateSecondSectionTitle(value){
            this.secondTemplate.second_section_title = value
        },
        setSecondTemplateSecondSectionImage(file){
            this.secondTemplate.second_section_image = file
        },
        setSecondTemplateSecondSectionDescription(value){
            this.secondTemplate.second_section_description = value
        },
        setSecondTemplateThirdSectionTitle(value){
            this.secondTemplate.third_section_title = value
        },
        setSecondTemplateThirdSectionDescription(value){
            this.secondTemplate.third_section_description = value
        },


        setThirdTemplateSecondSectionTitle(value){
            this.thirdTemplate.second_section_title = value
        },
        setThirdTemplateSecondSectionDescription(value){
            this.thirdTemplate.second_section_description = value
        },

        setThirdTemplateSecondSectionImage(file){
            this.thirdTemplate.second_section_image = file
        },
        setThirdTemplateFirstSectionDescription(data){
            this.thirdTemplate.first_section_description = data
        },
        setThirdTemplateThirdSectionTitle(value){
            this.thirdTemplate.third_section_title = value
        },
        setThirdTemplateThirdSectionDescription(value){
            this.thirdTemplate.third_section_description = value
        },
        setThirdTemplateThirdSectionImages(files){
            this.thirdTemplate.third_section_images = files
        },


    }

})
