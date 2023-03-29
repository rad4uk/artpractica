import { defineStore } from 'pinia'
export const adminCategoryStore = defineStore('adminCategoryStore', {
    state: () => {
        return {
            currentImage: Object,
            newImage: Object,
            allImages: [],
            categoryImages: [],
            isContentActive: true,
            category: null,
            categories: Array
        }
    },
    getters: {
        getContentActive: state => {
          return state.isContentActive
        },
        getCurrentImage: state => {
            return state.currentImage
        },
        getNewImage: state => {
            return state.newImage
        },
        getGalleryImages: state => {
            return state.allImages
        },
        getCategory: state => {
            return state.category
        },
        getCategoryImages: state => {
            return state.categoryImages
        },
        getCategories: state => {
            return state.categories
        }
    },
    actions: {

        setCategories(categories){
            this.categories = categories
        },

        updateCategoriesItems(deleteCategoryItem){
            this.categories.forEach((category,idx) => {
                if(deleteCategoryItem.id === category.id){
                    this.categories.splice(idx, 1)
                }
            })
        },

        updateCategoryImages(categoryImageId, newImage){
            // console.log(this.categoryImages)
            this.categoryImages.forEach((image,idx) => {
                if(categoryImageId === image.id){
                    this.categoryImages[idx] = newImage
                }
            })
        },

        setCategoryImages(images){
            images.forEach(image => {
                this.categoryImages.push(image)
            })
        },

        setContentActive(){
            this.isContentActive = !this.isContentActive
        },

        setCategory(category){
            this.category = category
        },

        setCurrentImage(image) {
            this.currentImage = image
        },

        setNewImage(image) {
            this.newImage = image
        },

        setGalleryImages(images){
            images.forEach(image => {
                this.allImages.push(image)
            })
        },
        async fetchGalleryImages() {
            try {
                let response = await axios.get('/api/images/')
                if (response.status === 200) {
                    this.setGalleryImages(response.data)
                }
            }catch (error){
                console.log(error)
            }finally {

            }

        }
    }
})
