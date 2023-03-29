<template>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="card-title">Все изображения</h4>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="filter-container p-0 row">

                                    <div class="filtr-item col-sm-6 col-md-4 col-lg-4 col-xl-3" data-category="1" data-sort="white sample"
                                         v-for="(image, index) in this.getImages()"
                                        :key="index"
                                    >
                                        <a :href="image.path" data-toggle="lightbox" :data-title="image.alt">
                                            <img :src="image.path" class="img-fluid mb-2" :alt="image.alt"/>
                                        </a>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import {useGalleryStore} from "@/store/galleryStore";
export default {
    name: "Content",
    data: () => {
        return {

        }
    },
    mounted() {
        this.setImagesStore()
    },
    setup() {
        const galleryStore = useGalleryStore()

        return { galleryStore }
    },
    methods: {
         setImagesStore(){
             axios.get('/api/images/')
                .then(res => {
                    this.galleryStore.setGalleryImages(res.data)
                })
        },
        getImages() {
            return this.galleryStore.getGalleryImages
        },
    }
}
</script>

<style scoped>
.filtr-item {
    height: 200px;
    margin-bottom: 20px;
}
.filtr-item img{
    height: 100%;
    width: 100%;
    object-fit: cover;
}
</style>
