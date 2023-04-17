import {defineStore} from 'pinia'

export const adminServicesStore = defineStore('servicesStore', {
    state: () => ({
        currentTemplate: null,
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
            first_section_title: '',
            first_section_description: '',
            first_section_image: null,
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
    },
    actions: {
        setCurrentTemplate(template){
            this.currentTemplate = template
        },
        setFirstTemplateFirstSectionTitle(value){
            this.firstTemplate.first_section_title = value
        },
        setFirstTemplateFirstSectionDescription(data){
            this.firstTemplate.first_section_description = data
        }
    }

})
