<template>
    <div class="project-preview">
        <div class="container">
            <div class="row">
                <h1 class="project-preview__title">{{ this.post.title }}</h1>

                <p class="project-preview__subtitle"
                    v-if="this.post.sub_title && this.post.sub_title.length > 0"
                >
                    {{ this.post.sub_title }}
                </p>
                <div class="project-preview__container"
                     @click="openSlider(this.preview_image)"
                >
                    <img :src="preview_image" alt="" class="project-preview__container-img">
                </div>
            </div>

            <div class="row"
                v-if="this.apartment_images.length > 0"
            >
                <image-slider
                    :apartment_images="this.apartment_images"
                    :post="this.post"
                    @openSlider="openSlider"
                ></image-slider>
                <p class="project-preview__text"
                    v-if="this.post.description !== null"
                >
                    {{this.post.description }}
                </p>
            </div>


        </div>
    </div>
</template>

<script>
import ImageSlider from "./ImageSlider.vue";
import {useProjectStore} from "@/store/frontend/projectStore";

export default {
    name: "PreviewComponent",
    props: ['post', 'preview_image', 'apartment_images'],
    components: {
        ImageSlider,
    },
    setup() {
        const store = useProjectStore()
        return {
            store,
        }
    },
    methods: {
        openSlider(file){
            this.$emit('openSlider', file);
        }
    }
}
</script>

<style lang="scss">
.swiper{
    .project-preview__container{
        @media (max-width: 1280px) {
            height: calc((100vw - 120px) / 2.11);
        }
        @media (max-width: 768px) {
            height: calc((100vw - 40px) / 2.11);
        }
        @media (max-width: 370px) {
            height: 132px;
        }
    }
}
</style>

