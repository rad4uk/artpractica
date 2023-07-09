<template>
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

<!--        <div class="gallery-slider">-->
<!--            <div class="gallery-slider__row">-->
<!--                <div class="gallery-slider__item">-->
<!--                    <img src="http://127.0.0.1/storage/images/project/9c6cfdb1-530d-4bb9-bdd2-be39e8358d47.webp" alt="" class="gallery-slider__image">-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <swiper-->
<!--            slides-per-view="1"-->
<!--            :navigation="{-->
<!--              prevEl: prev,-->
<!--              nextEl: next,-->
<!--            }"-->
<!--            :loop="true"-->
<!--            @swiper="onSwiper"-->
<!--            @slideChange="onSlideChange"-->
<!--            :modules="modules"-->
<!--            v-show="showSlider"-->
<!--            class="project__slider-images"-->
<!--            @click.self="closeSlider()"-->
<!--        >-->
<!--            <swiper-slide v-for="(image, idx) in this.slider_images_data" :key="idx">-->
<!--                <img :src="image">-->
<!--            </swiper-slide>-->
<!--        </swiper>-->
    </div>
</template>

<script>
import Widget1 from "@/Components/frontend/project/widjets/Widget1.vue";
import Widget2 from "@/Components/frontend/project/widjets/Widget2.vue";
import Widget3 from "@/Components/frontend/project/widjets/Widget3.vue";
import Widget4 from "@/Components/frontend/project/widjets/Widget4.vue";
import Widget5 from "@/Components/frontend/project/widjets/Widget5.vue";

import {Swiper, SwiperSlide} from 'swiper/vue';
import {Navigation, Pagination} from 'swiper';
import 'swiper/css';
import 'swiper/css/pagination';
import {ref} from "vue";

export default {
    name: "BodyComponent",
    props: ['data', 'slider_images_data'],
    components: {
        Widget1,
        Widget2,
        Widget3,
        Widget4,
        Widget5,
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
        }
    },
    data: () => {
        return {
            showSlider: false,
            swiper: null,
        }
    },
    methods: {
        onSwiper(swiper) {
            this.swiper = swiper;
        },
        handleOpenSlider(image) {
            this.showSlider = true;
            const index = this.slider_images_data.findIndex((img) => img === image);
            this.swiper.slideTo(index);
        },
        closeSlider(){
            this.showSlider = false
        }
    }

}
</script>

<style lang="scss">
.project{
    &__slider{
        &-images{
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
            .swiper-wrapper{
                position: absolute;
                height: 100%;
                max-height: 400px;
                .swiper-slide{
                    height: 100%;
                    display: flex;
                    justify-content: center;
                    img{
                        //width: 100%;
                        height: 100%;
                        object-fit: cover;
                    }
                }
            }

        }

    }
}



.gallery-slider{
    position: fixed;
    width: 80%;
    min-height: 50%;
    max-height: 70%;
    &__row{
        display: flex;
        flex-direction: row;
    }
}
</style>
