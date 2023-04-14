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
                <swiper
                    slides-per-view="1"
                    :space-between="20"
                    :navigation="{
                          prevEl: prev,
                          nextEl: next,
                        }"
                    :loop="true"
                    @swiper="onSwiper"
                    @slideChange="onSlideChange"
                    :modules="modules"
                    class="apartment__swiper"
                >
                    <div class="project-preview__arrow">
                        <div class="project-preview__arrow-text">Было / Стало</div>
                        <div ref="prev" class="project-preview__arrow-prev">
                            <svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.701096 7.29289C0.310572 7.68342 0.310572 8.31658 0.701096 8.70711L7.06506 15.0711C7.45558 15.4616 8.08875 15.4616 8.47927 15.0711C8.86979 14.6805 8.86979 14.0474 8.47927 13.6569L2.82242 8L8.47927 2.34315C8.86979 1.95262 8.86979 1.31946 8.47927 0.928933C8.08875 0.538409 7.45558 0.538409 7.06506 0.928933L0.701096 7.29289ZM2.4082 7H1.4082V9H2.4082V7Z"
                                    fill="white"/>
                            </svg>
                        </div>
                        <div ref="next" class="project-preview__arrow-next">
                            <svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.70711 7.29289C9.09763 7.68342 9.09763 8.31658 8.70711 8.70711L2.34315 15.0711C1.95262 15.4616 1.31946 15.4616 0.928933 15.0711C0.538409 14.6805 0.538409 14.0474 0.928933 13.6569L6.58579 8L0.928933 2.34315C0.538409 1.95262 0.538409 1.31946 0.928933 0.928933C1.31946 0.538409 1.95262 0.538409 2.34315 0.928933L8.70711 7.29289ZM7 7H8V9H7V7Z"
                                    fill="white"/>
                            </svg>
                        </div>
                    </div>

                    <swiper-slide v-for="(image, idx) in this.apartment_images" :key="idx">
                        <div class="project-preview__container project-scheme">
                            <img :src="image" alt="" class="project-preview__container-img">
                        </div>
                    </swiper-slide>
                </swiper>
                <p class="project-preview__text">
                    {{description }}
                </p>
            </div>


        </div>
    </div>
</template>

<script>
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Navigation, Pagination } from 'swiper';
import 'swiper/css';
import 'swiper/css/pagination';
import {ref} from "vue";
export default {
    name: "PreviewComponent",
    props: ['title', 'description', 'preview_image', 'apartment_images'],
    components: {
        Swiper,
        SwiperSlide,
        Pagination,
    },
    setup() {
        const onSwiper = (swiper) => {
        };
        const onSlideChange = () => {
        };

        const prev = ref(null);
        const next = ref(null);
        return {
            onSwiper,
            onSlideChange,
            modules: [Navigation, Pagination],
            prev,
            next,
        };
    },
}
</script>

<style lang="scss" scoped>
.project-scheme img{
    object-fit: cover;
}
.apartment__swiper{
    display: flex;
    flex-direction: column-reverse;
}
.project-preview__arrow{
    margin-bottom: 30px;
}
.project-preview__arrow:hover{
    cursor: pointer;
}
</style>
