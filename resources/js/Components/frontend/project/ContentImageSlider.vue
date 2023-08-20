<template>
    <swiper
        :style="{
          '--swiper-navigation-color': '#fff',
          '--swiper-pagination-color': '#fff',
        }"
        :zoom="true"
        :navigation="true"
        :modules="modules"
        @swiper="onSwiper"
        class="content-image-slider"
    >
        <swiper-slide
            v-for="(image, key) in this.getImages()"
            :key="key"
        >
            <div class="swiper-zoom-container">
                <img :src="image"/>
            </div>
        </swiper-slide>
        <div class="close-slider btn btn-danger"
             @click="closeSlider"
        >
        </div>
    </swiper>
</template>

<script>
import {Swiper, SwiperSlide} from 'swiper/vue';

import 'swiper/css';

import 'swiper/css/zoom';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

import {Zoom, Navigation, Pagination} from 'swiper';
import {useProjectStore} from "@/store/frontend/projectStore";

export default {
    name: 'ContentImageSlider',
    props: ['sliderIndex'],
    components: {
        Swiper,
        SwiperSlide,
    },
    mounted() {
        this.swiper.slideTo(this.sliderIndex)
    },
    data: () => {
        return {
            showSlider: false,
            swiper: null,
        }
    },
    setup() {
        const onSwiper = (swiper) => {
        };
        const store = useProjectStore()
        return {
            onSwiper,
            store,
            modules: [Zoom, Navigation, Pagination],
        };
    },

    methods: {
        getImages() {
            return this.store.getContentImagesSliderData
        },
        onSwiper(swiper) {
            this.swiper = swiper;
        },
        closeSlider() {
            this.$emit('closeSlider');
        }
    },
};
</script>

<style lang="scss">
.close-slider {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    position: absolute;
    z-index: 12;
    top: 10px;
    right: 10%;
    cursor: pointer;
}

.close-slider:before, .close-slider:after {
    content: "";
    position: absolute;
    width: 34px;
    height: 2px;
    background: white;
}

.close-slider:before {
    transform: rotate(45deg);
}

.close-slider:after {
    transform: rotate(-45deg);
}

.content-image-slider {
    position: fixed;
    z-index: 12;
    background: black;
}

.swiper {
    width: 100%;
    height: 100%;
}

.swiper-slide {
    overflow: hidden;
}

.swiper-zoom-container img {
    max-width: 80%;
    max-height: 80%;
}

.swiper-button-prev {
    @media (max-width: 920px) {
        &::after {
            font-size: 24px;
        }
    }
    @media (max-width: 520px) {
        left: 0;
        &::after {
            font-size: 14px;
        }
    }
}

.swiper-button-next {
    @media (max-width: 920px) {
        &::after {
            font-size: 24px;
        }
    }
    @media (max-width: 520px) {
        right: 0;
        &::after {
            font-size: 14px;
        }
    }
}
</style>
