<template>
    <div class="project-preview">
        <div class="container">
            <div class="row">
                <h1 class="project-preview__title">{{ title }}</h1>
                <div class="project-preview__container">
                    <img :src="preview_image" alt="" class="project-preview__container-img">
                </div>
            </div>

            <div class="row">
                <image-slider :apartment_images="this.apartment_images"></image-slider>
                <p class="project-preview__text">
                    {{description }}
                </p>
            </div>


        </div>
    </div>
</template>

<script>
import ImageSlider from "./ImageSlider.vue";
export default {
    name: "PreviewComponent",
    props: ['title', 'description', 'preview_image', 'apartment_images'],
    components: {
        ImageSlider,
    },
}
</script>


