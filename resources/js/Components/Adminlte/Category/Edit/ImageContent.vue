<template>
    <div class="col-12 modal-body__images" style="display: flex;flex-direction: row;flex-wrap: wrap;">
        <ImageItem
            v-for="(image, key) in this.getImages()"
            :key="key"
            :image="image"
            style="height: 150px; margin-bottom: 15px"
            @click="setNewImage(image)"
        ></ImageItem>
    </div>
</template>

<script>
import ImageItem from "@/Components/Adminlte/Category/Edit/ImageItem.vue";
import {adminCategoryStore} from "@/store/categoryStore";
export default {
    name: "ImageContent",
    components: {
        ImageItem
    },
    data: () => {
        return {
            images: null
        }
    },
    setup() {
        const categoryStore = adminCategoryStore()

        return { categoryStore }
    },
    mounted() {
        this.categoryStore.fetchGalleryImages()
        // this.images = this.getImages()
    },
    methods: {
        getImages() {
            return this.categoryStore.getGalleryImages
        },
        setNewImage(image){
            this.categoryStore.setNewImage(image)
        },
    }
}
</script>

<style scoped>

</style>
