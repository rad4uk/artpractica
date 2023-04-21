<template>
    <div class="professional">
        <div class="container">
            <div class="professional__title">
                <h1>ВЫБИРАЙТЕ ПРОФЕССИОНАЛОВ</h1>
            </div>
            <div class="professional__row">
                <slider
                    v-if="this.sliders_data.firstSliderData"
                    :data="this.sliders_data.firstSliderData"
                ></slider>
                <slider
                    v-if="this.sliders_data.secondSliderData"
                    :data="this.sliders_data.secondSliderData"
                ></slider>
                <slider
                    v-if="this.sliders_data.thirdSliderData"
                    :data="this.sliders_data.thirdSliderData"
                >
                </slider>
            </div>
        </div>

    </div>
</template>

<script>
import { ref } from 'vue';

import Slider from "./Slider.vue";
export default {
    name: "ProfessionalComponent",
    props: ['sliders_data'],
    components: {
        Slider
    },
    data: () => {
        return {

        }
    },
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
