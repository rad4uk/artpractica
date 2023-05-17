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
                    :breakpoints="{
                        320: { slidesPerView: 1},
                        520: { slidesPerView: 2},
                    }"
                    :loop="true"
                    @swiper="onSwiper"
                    @slideChange="onSlideChange"
                    :class="'project__swiper'"
                >
                    <swiper-slide
                        v-for="(post, idx) in this.posts"
                        :key="idx"
                    >
                        <project-item
                            :item="post"
                            :key="idx"
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
import {Swiper, SwiperSlide} from 'swiper/vue';
import {Navigation, Pagination} from 'swiper';
import 'swiper/css';
import 'swiper/css/pagination';
import {ref} from "vue";

export default {
    name: "PostSlider",
    props: ['posts'],
    components: {
        ProjectItem,
        Swiper,
        SwiperSlide,
    },
    mounted() {
      console.log(this.posts)
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
.project__row{
    @media (max-width: 520px) {
        flex-direction: row;
    }
}
</style>
