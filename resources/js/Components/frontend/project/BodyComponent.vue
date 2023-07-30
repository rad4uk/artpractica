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
        <!--             v-show="showSlider"-->
        <!--             :class="{'gallery-slider-active': showSlider}"-->
<!--        <div class="gallery-slider gallery-slider-active"-->

<!--             @click.self="closeSlider()"-->
<!--        >-->
<!--            <div class="gallery-slider__row">-->
<!--                <swiper-->
<!--                    slides-per-view="1"-->
<!--                    :navigation="{-->
<!--                       prevEl: prev,-->
<!--                       nextEl: next,-->
<!--                    }"-->
<!--                    :loop="true"-->
<!--                    @swiper="onSwiper"-->
<!--                    @slideChange="onSlideChange"-->
<!--                    :modules="modules"-->
<!--                >-->
<!--                    <div class="gallery-slider__arrows">-->
<!--                        <div class="gallery-slider__arrows-prev"-->
<!--                             v-if="this.slider_images_data.length > 1" ref="prev" >-->
<!--                            <svg width="21" height="48" viewBox="0 0 21 48" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                                <path d="M19 1L2 24L19 47" stroke="white" stroke-width="3"/>-->
<!--                            </svg>-->

<!--                        </div>-->
<!--                        <div class="gallery-slider__arrows-next" v-if="this.slider_images_data.length > 1" ref="next">-->
<!--                            <svg width="21" height="48" viewBox="0 0 21 48" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                                <path d="M2 1L19 24L2 47" stroke="white" stroke-width="3"/>-->
<!--                            </svg>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <swiper-slide v-for="(image, idx) in this.slider_images_data" :key="idx">-->
<!--                        <div class="gallery-slider__item">-->
<!--                            <img class="gallery-slider__image" :src="image" alt="">-->
<!--                        </div>-->
<!--                    </swiper-slide>-->
<!--                </swiper>-->
<!--            </div>-->
<!--        </div>-->

        <!--        <swiper-->
        <!--            slides-per-view="1"-->
        <!--            :navigation="{-->
        <!--                       prevEl: prev,-->
        <!--                       nextEl: next,-->
        <!--                    }"-->
        <!--            :loop="true"-->
        <!--            @swiper="onSwiper"-->
        <!--            @slideChange="onSlideChange"-->
        <!--            :modules="modules"-->
        <!--            @click.self="closeSlider()"-->
        <!--        >-->
        <!--            <swiper-slide v-for="(image, idx) in this.slider_images_data" :key="idx">-->
        <!--                <div style="background: #ffffff">-->
        <!--                    123-->
        <!--                </div>-->
        <!--            </swiper-slide>-->
        <!--        </swiper>-->


        <!--        <div class="gallery-slider">-->
        <!--            <div class="gallery-slider__row">-->
        <!--                <swiper-slide v-for="(image, idx) in this.slider_images_data" :key="idx">-->
        <!--                    <div class="gallery-slider__item">-->
        <!--                        <img class="gallery-slider__image" :src="image" alt="">-->
        <!--                    </div>-->
        <!--                </swiper-slide>-->
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
            // console.log(image)
            // this.showSlider = true;
            // const index = this.slider_images_data.findIndex((img) => img === image);
            // this.swiper.slideTo(index);
        },
        closeSlider() {
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


.gallery-slider {
    position: fixed;
    width: 100%;
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    z-index: 5;
    display: flex;
    justify-content: center;

    &__row {
        //position: absolute;
        //z-index: 5;
        //top: 100px;
        //right: 50%;
        //transform: translateX(50%);
        margin-top: 100px;
        position: relative;
        z-index: 5;
        max-width: 1280px;
        padding: 0 60px;
        @media (max-width: 992px) {
            max-width: 90%;
        }
        @media (max-width: 768px) {
            padding: 0 20px;
        }

    }

    &__item{
        height: 100%;
    }

    &__image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    &__arrows{
        position: absolute;
        right: -26px;
        top: 0;
        bottom: 0;
        justify-content: space-between;
        left: -26px;
        display: flex;
        &-prev{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        &-next{
            display: flex;
            justify-content: center;
            align-items: center;
        }
    }


}

.gallery-slider-active:before {
    content: "";
    position: absolute;
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    z-index: 4;
    background: rgba(16, 14, 12, 0.8);;
}

.swiper {
    @media (max-width: 992px) {
        height: 90%;
    }
}
</style>
