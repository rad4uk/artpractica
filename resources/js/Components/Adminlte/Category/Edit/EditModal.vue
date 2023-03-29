<template>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 700px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Выберите изображение</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <NavTabs></NavTabs>

                    <ImageContent v-show="this.getContentActive()"></ImageContent>

                    <ImageForm
                        v-show="!this.getContentActive()"
                    ></ImageForm>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button v-if="this.getContentActive()" @click.prevent="updateImage" type="button" class="btn btn-primary">Сохранить изменения</button>
                    <button v-if="!this.getContentActive()" @click.prevent="store" type="button" class="btn btn-primary">{{this.getButtonValue()}}</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import NavTabs from "@/Components/Adminlte/Category/Edit/NavTabs.vue";

import ImageContent from "@/Components/Adminlte/Category/Edit/ImageContent.vue";
import ImageForm from "@/Components/Adminlte/Category/Edit/ImageForm.vue";

import {adminCategoryStore} from "@/store/categoryStore";
import {uploadCategoryImageStore} from "@/store/uploadCategoryImageStore";

export default {
    name: "EditModal",
    components: {
        NavTabs,
        ImageContent,
        ImageForm
    },
    setup() {
        const categoryStore = adminCategoryStore()
        const categoryImageStore = uploadCategoryImageStore()

        return { categoryStore, categoryImageStore }
    },
    data: function () {
        return {
            newImage: null,
            category: null,
            currentCategoryImage: null,
        }
    },
    methods: {
        setImageStore(image){
            this.categoryStore.setCurrentImage(image)
        },

        getContentActive(){
            return this.categoryStore.getContentActive
        },

        getButtonDisabled(){
            return this.categoryImageStore.getButtonIsDisabled
        },

        getButtonValue(){
            return this.categoryImageStore.getButtonValue
        },
        getNewCategoryImage(){
            return this.categoryImageStore.getNewCategoryImage
        },

        updateImage() {
            this.category = this.categoryStore.getCategory
            this.currentCategoryImage = this.categoryStore.getCurrentImage
            this.newImage = this.categoryStore.getNewImage
            // console.log(this.currentCategoryImage)
            // console.log(this.newImage)

            const form = new FormData()

            form.append('categoryId', this.category.id)
            form.append('categoryImageId', this.currentCategoryImage.id)
            form.append('newImageId', this.newImage.id)

            axios.post('/api/category/image/update', form)
                .then(res => {
                    if (res.data.message === 'success' && res.status === 200) {
                        // console.log(this.category.id, res.data.data)

                        this.categoryStore.updateCategoryImages(this.currentCategoryImage.id, res.data.data)

                        // this.galleryStore.setGalleryImages(res.data.data)
                    }
                })
                .catch(error => {
                    const response = error.response
                    if (response.status === 422) {
                        this.message.isResponse = true
                        this.message.textData = response.data.errors.image
                    }
                }).finally(() => {

                })
        },

        async store() {
            const category = this.categoryStore.getCategory
            const currentCategoryImage = this.categoryStore.getCurrentImage

            this.categoryImageStore.setButtonValue('Идет загрузка...')
            this.categoryImageStore.setButtonDisabled(true)

            const images = new FormData()
            const files = this.categoryImageStore.getDropzone.getAcceptedFiles()

            files.forEach(file => {
                images.append('image', file)
                this.categoryImageStore.removeFileDropzone(file)
            })

            images.append('categoryId', category.id)
            images.append('categoryImageId', currentCategoryImage.id)

            await this.categoryImageStore.storeImage(images)

            console.log(category.id, this.getNewCategoryImage())

            this.categoryStore.updateCategoryImages(currentCategoryImage.id, this.getNewCategoryImage())

        },
    }
}
</script>

<style scoped>

</style>
