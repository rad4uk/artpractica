<template>
    <div class="professional">
        <div class="container">
            <div class="professional__title">
                <h1>ВЫБИРАЙТЕ ПРОФЕССИОНАЛОВ</h1>
            </div>
            <div class="professional__row">
                <slider :professional_team="professional_team" :title="'Проектирование и реализация крупных коммерческих объектов '"></slider>
                <slider :professional_team="team" :title="'Собственное мебельное производство'"></slider>
                <slider :professional_team="professional" :title="'Команда профессионалов, влюбленных в свое дело'"></slider>
            </div>
        </div>

    </div>
</template>

<script>
import { ref } from 'vue';

import Slider from "./Slider.vue";
export default {
    name: "ProfessionalComponent",
    components: {
        Slider
    },
    data: () => {
        return {
            professional_team: [
                {
                    'title': 'Проектирование и реализация крупных коммерческих объектов',
                    'imagePath': '/images/img_11.png',
                    'slug': '#'
                },
                {
                    'title': 'Проектирование и реализация крупных коммерческих объектов',
                    'imagePath': '/images/img_12.png',
                    'slug': '#'
                },
                {
                    'title': 'Проектирование и реализация крупных коммерческих объектов',
                    'imagePath': '/images/img_13.png',
                    'slug': '#'
                }
            ],
            team: [
                {
                    'title': 'Собственное мебельное производство',
                    'imagePath': '/images/img_12.png',
                    'slug': '#'
                },
                {
                    'title': 'Собственное мебельное производство',
                    'imagePath': '/images/img_13.png',
                    'slug': '#'
                },
                {
                    'title': 'Собственное мебельное производство',
                    'imagePath': '/images/img_11.png',
                    'slug': '#'
                },
            ],
            professional: [
                {
                    'title': 'Профессиональная команда дизайнеров',
                    'imagePath': '/images/img_13.png',
                    'slug': '#'
                },
                {
                    'title': 'Профессиональная команда дизайнеров',
                    'imagePath': '/images/img_12.png',
                    'slug': '#'
                },
                {
                    'title': 'Профессиональная команда дизайнеров',
                    'imagePath': '/images/img_11.png',
                    'slug': '#'
                }
            ]
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
