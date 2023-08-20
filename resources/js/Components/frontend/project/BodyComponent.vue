<template>
    <PreviewComponent
        :post="this.post"
        :apartment_images="this.apartment_images"
        :preview_image="this.preview_image"
        @openSlider="handleOpenSlider"
    >
    </PreviewComponent>

    <div class="project-wrapper">
        <component
            v-for="(widget, idx) in this.data"
            :key="idx"
            :dataKey="idx"
            :is="widget.name"
            :data="widget"
            @openSlider="handleOpenSlider"
        >
        </component>
    </div>

    <ContentImageSlider
        v-if="this.showSlider"
        :sliderIndex="this.sliderIndex"
        @closeSlider="handleCloseSlider"
    ></ContentImageSlider>
</template>

<script>
import Widget1 from "@/Components/frontend/project/widjets/Widget1.vue";
import Widget2 from "@/Components/frontend/project/widjets/Widget2.vue";
import Widget3 from "@/Components/frontend/project/widjets/Widget3.vue";
import Widget4 from "@/Components/frontend/project/widjets/Widget4.vue";
import Widget5 from "@/Components/frontend/project/widjets/Widget5.vue";
import ContentImageSlider from "@/Components/frontend/project/ContentImageSlider.vue";
import PreviewComponent from "@/Components/frontend/project/PreviewComponent.vue";

import {Swiper, SwiperSlide} from 'swiper/vue';
import {Zoom, Navigation, Pagination} from 'swiper';
import 'swiper/css';
import 'swiper/css/pagination';
import {ref} from "vue";
import {useProjectStore} from "@/store/frontend/projectStore";

export default {
    name: "BodyComponent",
    props: ['post', 'preview_image', 'apartment_images','data', 'slider_images_data'],
    components: {
        Widget1,
        Widget2,
        Widget3,
        Widget4,
        Widget5,
        Swiper,
        SwiperSlide,
        Pagination,
        ContentImageSlider,
        PreviewComponent
    },
    setup() {
        const store = useProjectStore()

        const onSwiper = (swiper) => {
        };
        const onSlideChange = () => {
        };

        const prev = ref(null);
        const next = ref(null);

        return {
            store,
            onSwiper,
            onSlideChange,
            modules: [Zoom, Navigation, Pagination],
            prev,
            next,
        }
    },
    mounted() {
        this.store.setContentImagesSliderData(this.slider_images_data)
    },
    data: () => {
        return {
            showSlider: false,
            swiper: null,
            sliderIndex: 0
        }
    },
    methods: {
        onSwiper(swiper) {
            this.swiper = swiper;
        },
        handleOpenSlider(image) {
            this.showSlider = true;
            const images = this.store.getContentImagesSliderData
            this.sliderIndex = images.findIndex((img) => img === image);
        },
        handleCloseSlider() {
            this.showSlider = false
        }
    }

}
</script>

<style lang="scss">
.project {
    &__slider {
        &-images {
            z-index: 10;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100vh;
            max-width: 61%;
            display: flex;
            justify-content: center;
            align-items: center;

            //padding: 50px 100px;
            .swiper-wrapper {
                position: absolute;
                height: 100%;
                max-height: 400px;

                .swiper-slide {
                    height: 100%;
                    display: flex;
                    justify-content: center;

                    img {
                        //width: 100%;
                        height: 100%;
                        object-fit: cover;
                    }
                }
            }

        }

    }
}


//.gallery-slider {
//    position: fixed;
//    width: 100%;
//    top: 0;
//    bottom: 0;
//    right: 0;
//    left: 0;
//    z-index: 5;
//    display: flex;
//    justify-content: center;
//
//    &__row {
//        //position: absolute;
//        //z-index: 5;
//        //top: 100px;
//        //right: 50%;
//        //transform: translateX(50%);
//        margin-top: 100px;
//        position: relative;
//        z-index: 5;
//        max-width: 1280px;
//        padding: 0 60px;
//        @media (max-width: 992px) {
//            max-width: 90%;
//        }
//        @media (max-width: 768px) {
//            padding: 0 20px;
//        }
//
//    }
//
//    &__item{
//        height: 100%;
//    }
//
//    &__image {
//        width: 100%;
//        height: 100%;
//        object-fit: cover;
//    }
//
//    &__arrows{
//        position: absolute;
//        right: -26px;
//        top: 0;
//        bottom: 0;
//        justify-content: space-between;
//        left: -26px;
//        display: flex;
//        &-prev{
//            display: flex;
//            justify-content: center;
//            align-items: center;
//        }
//        &-next{
//            display: flex;
//            justify-content: center;
//            align-items: center;
//        }
//    }
//
//
//}

//.gallery-slider-active:before {
//    content: "";
//    position: absolute;
//    top: 0;
//    bottom: 0;
//    right: 0;
//    left: 0;
//    z-index: 4;
//    background: rgba(16, 14, 12, 0.8);;
//}


</style>
