<template>
    <div class="col-sm-4 modal-body__images-item">
        <img
            v-if="image.id === this.getImageId()"
            src="http://art.practic.local/storage/galka.png"
            class="modal-body__images-item-chosen"
        >

        <img :src="image.path" :alt="image.alt" style="height: 100%; width:100%; object-fit: cover">
    </div>
</template>

<script>
import {adminCategoryStore} from "@/store/categoryStore";
export default {
    name: "ImageItem",
    props: ['image'],
    setup() {
        const categoryStore = adminCategoryStore()

        return { categoryStore }
    },
    methods: {
        getImageId(){
            return this.categoryStore.getNewImage.id
        }
    }
}
</script>

<style scoped>
.modal-body__images-item{
    position: relative;
}
.modal-body__images-item-chosen{
    position: absolute;
    width: 100px;
    left: 27%;
    top: 20%;
}
</style>
