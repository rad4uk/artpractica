import { defineStore } from 'pinia'
export const uploadCategoryImageStore = defineStore('uploadCategoryImageStore', {
    state: () => {
        return {
            newCategoryImage: Object,
            dropzone: null,
            disabled: true,
            buttonValue: 'Загрузить',
            message: {
                textData: [],
                isResponse: false,
                status: 'danger',
            }

        }
    },
    getters: {
        getButtonIsDisabled: state => {
            return state.disabled
        },
        getButtonValue: state => {
            return state.buttonValue
        },
        getTextData: state => {
            return state.message.textData
        },
        getIsResponse: state => {
            return state.message.isResponse
        },
        getStatus: state => {
            return state.message.status
        },
        getDropzone: state => {
            return state.dropzone
        },
        getNewCategoryImage: state => {
            return state.newCategoryImage
        }
    },
    actions: {
        removeFileDropzone(file){
            this.dropzone.removeFile(file)
        },
        setIsResponse(isResponse){
            this.message.isResponse = isResponse
        },
        setDropzone(dropzone){
            this.dropzone = dropzone
        },
        setButtonValue(value){
            this.buttonValue = value
        },
        setButtonDisabled(isActive){
            this.disabled = isActive
        },
        async storeImage(images){
            try {
                let res = await axios.post('/api/category/image/create', images)
                if (res.data.message === 'success' && res.status === 200) {
                    this.message.textData = res.data.textData
                    this.message.isResponse = true
                    this.message.status = res.data.message

                    this.newCategoryImage = res.data.data
                    console.log(this.newCategoryImage)
                    // this.categoryStore.updateCategoryImages(categoryId, res.data.data)
                    // this.galleryStore.setGalleryImages(res.data.data)
                }
            }catch (error){
                const response = error.response
                if (response.status === 422) {
                    this.message.isResponse = true
                    this.message.textData = response.data.errors.image
                }
            }finally {
                this.buttonValue = 'Загрузить'
                this.disabled = false

                setTimeout(() => {
                    this.message.status = 'danger';
                    this.message.textData = [];
                    this.message.isResponse = false;
                }, 8000)
            }

            //  axios.post('/api/category/image/create', images)
            //     .then(res => {
            //         // console.log(res.data)
            //         if (res.data.message === 'success' && res.status === 200) {
            //             this.message.textData = res.data.textData
            //             this.message.isResponse = true
            //             this.message.status = res.data.message
            //
            //             this.newCategoryImage = res.data.data
            //             console.log(this.newCategoryImage)
            //             // this.categoryStore.updateCategoryImages(categoryId, res.data.data)
            //             // this.galleryStore.setGalleryImages(res.data.data)
            //         }
            //     })
            //     .catch(error => {
            //         const response = error.response
            //         if (response.status === 422) {
            //             this.message.isResponse = true
            //             this.message.textData = response.data.errors.image
            //         }
            //     }).finally(() => {
            //     this.buttonValue = 'Загрузить'
            //     this.disabled = false
            //
            //     setTimeout(() => {
            //         this.message.status = 'danger';
            //         this.message.textData = [];
            //         this.message.isResponse = false;
            //     }, 8000)
            // })
        }
    }
})
