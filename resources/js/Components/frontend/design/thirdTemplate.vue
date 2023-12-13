<template>
    <div class="atelier">
        <div class="atelier-furniture">
            <div class="container">
                <div class="atelier-furniture-title service-title">
                    <a href="https://apfurniture.ru/" class="atelier-furniture-link">
                        {{this.data.title}}
                    </a>
                </div>
                <div class="atelier-furniture-text" v-html="this.data.description">

                </div>
                <div class="atelier-furniture-image">
                    <img :src="this.data.preview_image" :alt="this.data.title">
                </div>
            </div>
        </div>

        <div class="atelier-team">
            <div class="container">
                <div class="atelier-team-title service-title">
                    {{this.data.second_section_title}}
                </div>
                <div class="atelier-team-text">
                    <p class="service-text" v-html="this.data.second_section_description">

                    </p>
                    <!--                        <span>ARTPRACTICA FURNITURE — </span>это опытная команда профессионалов и высокотехнологичное производство полного цикла. Успешно воплощаем идеи дизайнеров. Индивидуальный подход к каждому проекту.-->

                </div>
                <div class="row">
                    <div class="equipment__column">
                        <div class="equipment__image">
                            <img
                                lazy
                                v-lazy="{
                                  src: this.data.second_section_image,
                                  error: 'url',
                                }"
                                alt="">
                        </div>
                    </div>
                    <div class="equipment__column" v-if="this.data.first_section_description.length > 0">
                        <div
                            v-for="(item, idx) in this.data.first_section_description"
                            class="equipment__item">
                            <div class="equipment__item-title">
                                <h4>
                                    <span>0{{idx+1}}</span>
                                </h4>
                            </div>
                            <div class="equipment__item-text">
                                <p>
                                    {{ item.textarea }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="atelier-apfurniture">
            <div class="container">
                <div class="atelier-apfurniture-title service-title">
                    <a href="https://apfurniture.ru/" class="atelier-furniture-link">{{this.data.third_section_title}}</a>
                </div>
                <div class="atelier-apfurniture-text">
                    <p class="service-text">
                        {{this.data.third_section_description}}
                    </p>
                </div>
                <div class="row" v-if="this.data.third_section_images.length > 0">

                    <div
                        v-for="(item, idx) in this.data.third_section_images"
                        :key="idx"
                        class="atelier-apfurniture-item">
                        <img
                            lazy
                            v-lazy="{
                              src: item,
                              error: 'url',
                            }"
                            alt="" class="atelier-apfurniture-image">
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "thirdTemplate",
    props: ['data'],
}
</script>

<style scoped>
.service-text a{
    color: #ffffff;
    text-decoration: underline;
}
</style>
