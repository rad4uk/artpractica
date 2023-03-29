<template>
    <div class="row category">
        <div class="col-12 category__images" style="display: flex; flex-direction: row; flex-wrap: wrap">
            <div
                class="col-3 col-md-6 col-xl-3 category__images-item"
                v-for="(img, key) in this.getCategoryImages()"
                :key="key"
            >
                <img :src="img.image.path" :alt="img.image.alt">
                <button class='btn btn-info btn-sm' data-toggle="modal" data-target="#exampleModal" @click="setImageStore(img)">Изменить</button>
                <button class="btn btn-danger btn-sm">Удалить</button>
            </div>

            <EditModal></EditModal>

        </div>
    </div>
</template>

<script>
import {adminCategoryStore} from "@/store/categoryStore";

import EditModal from "@/Components/Adminlte/Category/Edit/EditModal.vue";
export default {
    name: "CategoryImage",
    components: {
      EditModal,
    },
    props: ['category'],
    setup() {
        const categoryStore = adminCategoryStore()

        return { categoryStore }
    },
    data: function (){
      return {
          currentImage: null,
          categoryImages: []
      }
    },
    mounted() {
        // this.categoryImages = this.categoryStore.getCategoryImages

        this.categoryStore.setCategory(this.category)
        this.fetchCategoryImages()
        // this.categoryStore.setCategoryImages(this.category.category_images)
        // console.log(this.category.category_images)
    },
    methods: {
        getCategoryImages(){
            return this.categoryStore.getCategoryImages
        },
        setImageStore(image){
            this.categoryStore.setCurrentImage(image)
        },
        fetchCategoryImages(){
            const category = this.categoryStore.getCategory
            axios.get('/api/category/image',{
                params: {
                    id: category.id
                }
            })
            .then(res => {
                this.categoryStore.setCategoryImages(res.data)
            })
        }
    }
}
</script>

<style scoped>
.category__images-item{
    position: relative;
    height: 300px;
}
.category__images-item .btn-info{
    position: absolute;
    top: 0;
    left: 7.5px;
}
.category__images-item .btn-danger{
    position: absolute;
    top: 0;
    right: 7.5px;
}
.category__images-item img{
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>
