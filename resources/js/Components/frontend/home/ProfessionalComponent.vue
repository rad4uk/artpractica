<template>
    <div class="professional">
        <div class="container">
            <div class="professional__title">
                <h1>ВЫБИРАЙТЕ ПРОФЕССИОНАЛОВ</h1>
            </div>
            <div class="professional__row">
                <div class="professional__column">
                    <swiper
                        slides-per-view="1"
                        :space-between="20"
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
                        <swiper-slide v-for="(product, idx) in this.products" :key="idx">
                            <div class="professional__text">
                                <p>{{product.title}}</p>
                            </div>
                            <div class="professional__image">
                                <img :src="product.imagePath" alt="">
                                <div ref="prev" class="arrow-prev swiper-button-prev arrow">
                                    <svg class="swiper-button-prev" width="21" height="43" viewBox="0 0 21 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19 2L4 21.5L19 41" stroke="white" stroke-opacity="0.7" stroke-width="5"/>
                                    </svg>
                                </div>
                                <div ref="next" class="arrow-next swiper-button-next arrow">
                                    <svg class="swiper-button-next" width="21" height="43" viewBox="0 0 21 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19 2L4 21.5L19 41" stroke="white" stroke-opacity="0.7" stroke-width="5"/>
                                    </svg>
                                </div>
                            </div>
                        </swiper-slide>
                    </swiper>

                </div>

            </div>
        </div>

    </div>
</template>

<script>
import { ref } from 'vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Navigation, Pagination } from 'swiper';
import 'swiper/css';
import 'swiper/css/pagination';

export default {
    name: "ProfessionalComponent",
    data: () => {
        return {
            products: [
                {
                    'title': 'Проектирование и реализация крупных коммерческих объектов',
                    'imagePath': '/images/img_11.png',
                    'slug': '#'
                },
                {
                    'title': 'Собственное мебельное производство',
                    'imagePath': '/images/img_12.png',
                    'slug': '#'
                },
                {
                    'title': 'Профессиональная команда дизайнеров',
                    'imagePath': '/images/img_13.png',
                    'slug': '#'
                }
            ]
        }
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
    components: {
        Swiper,
        SwiperSlide,
        Pagination
    }
}
</script>

<style lang="scss" scoped>
.professional__slide{
    /*flex: 0 1 66.666%;*/
}
.professional{
    &__image{
        position: relative;
    }
}
.arrow-prev{
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    padding: 0 66px 0 21px;
    display: flex;
    align-items: center;
    background: transparent;
}
.arrow-next{
    position: absolute;
    top: 0;
    bottom: 0;
    right: 0;
    padding: 0 66px 0 21px;
    display: flex;
    align-items: center;
    background: transparent;
    transform: matrix(-1, 0, 0, 1, 0, 0);
}
.arrow svg{
    z-index: 2;
    cursor: pointer;
}
.arrow::before {
    content: "";
    position: absolute;
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    z-index: 1;
    background: linear-gradient(90deg, rgba(1, 1, 1, 0.45) 0%, rgba(1, 1, 1, 0.21) 50.52%, rgba(0, 0, 0, 0) 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.professional__image:hover .arrow::before {
    opacity: 1;
    cursor: pointer;
}
</style>
