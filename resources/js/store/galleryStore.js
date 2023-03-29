// import {createStore} from 'vuex'
//
//
// export default createStore({
//     state: {
//         galleryImages: [],
//     },
//     getters: {
//         getGalleryImages: state => {
//             return state.galleryImages
//         },
//     },
//     mutations: {
//         setGalleryImages(state, payload) {
//             payload.forEach(image => {
//                 this.state.galleryImages.push(image)
//             })
//         }
//     }
// })

import { defineStore } from 'pinia'
export const useGalleryStore = defineStore('gallery', {
    state: () => {
        return {
            galleryImages: [],
        }
    },
    getters: {
        getGalleryImages: state => {
            return state.galleryImages
        },
    },
    actions: {
        setGalleryImages(payload) {
            // console.log(payload)
            payload.forEach(image => {
                this.galleryImages.push(image)
            })
        },
    }
})
