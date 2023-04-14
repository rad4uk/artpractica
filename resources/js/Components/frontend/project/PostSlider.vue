<template>
    <div class="project">
        <div class="container">
            <h4 class="project-title">
                ДРУГИЕ ПРОЕКТЫ
            </h4>

            <div class="project__row">
                <swiper
                    slides-per-view="2"
                    :space-between="30"
                    :loop="true"
                    @swiper="onSwiper"
                    @slideChange="onSlideChange"
                    class="professional__slide"
                >
                    <swiper-slide
                        v-for="(post, idx) in this.posts"
                        :key="idx"
                    >
                        <project-item
                            :item="post"
                        >
                        </project-item>
                    </swiper-slide>

                </swiper>
            </div>
        </div>
    </div>
</template>

<script>
import ProjectItem from "../portfolio/ProjectItem.vue";
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';
import 'swiper/css/pagination';

export default {
    name: "PostSlider",
    props: ['posts'],
    components: {
        ProjectItem,
        Swiper,
        SwiperSlide,
    },
    setup() {
        const onSwiper = (swiper) => {
        };
        const onSlideChange = () => {
        };
        return {
            onSwiper,
            onSlideChange,
        };
    },
}
</script>

<style lang="scss" scoped>
.project__item{
    padding: 0;
    height: 100%;
}
</style>
