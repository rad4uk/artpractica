<template>

    <div class="professional__column">
        <div class="professional__text">
            <p>{{ this.data.title }}</p>
        </div>
        <swiper
            slides-per-view="1"
            :space-between="20"
            :autoHeight="false"
            :navigation="{
                          prevEl: prev,
                          nextEl: next,
                        }"
            :loop="true"
            :pagination="{ clickable: true }"
            @swiper="onSwiper"
            @slideChange="onSlideChange"
            :modules="modules"
            class="professional__slide"
        >
            <div ref="prev" class="arrow-prev swiper-button-prev arrow">
                <svg class="swiper-button-prev" width="21" height="43" viewBox="0 0 21 43" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 2L4 21.5L19 41" stroke="white" stroke-opacity="0.7" stroke-width="5"/>
                </svg>
            </div>
            <div ref="next" class="arrow-next swiper-button-next arrow">
                <svg class="swiper-button-next" width="21" height="43" viewBox="0 0 21 43" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 2L4 21.5L19 41" stroke="white" stroke-opacity="0.7" stroke-width="5"/>
                </svg>
            </div>
            <swiper-slide v-for="(image, idx) in this.data.files" :key="idx">
                <div class="professional__image">
                    <picture>
                        <source v-if="image.small" :srcset="image.small" media="(max-width: 330px)"/>
                        <source v-if="image.medium" :srcset="image.medium" media="(max-width: 520px)"/>
                        <source v-if="image.large" :srcset="image.large" media="(max-width: 768px)"/>
                        <img
                            lazy
                            v-lazy="{
                              src: image.default,
                              error: 'error',
                            }"
                            alt=""
                        >
                    </picture>
                </div>
            </swiper-slide>
        </swiper>
    </div>
</template>

<script>
import {Swiper, SwiperSlide} from 'swiper/vue';
import {Navigation, Pagination} from 'swiper';
import 'swiper/css';
import 'swiper/css/pagination';
import {ref} from "vue";

export default {
    name: "Slider",
    props: ['data'],
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

<style lang="scss">

</style>
