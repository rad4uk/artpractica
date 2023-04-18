<template>
    <div>
        <slot name="designTextComponent"></slot>

        <div class="equipment">
            <div class="container">
                <div class="equipment__title">
                    {{this.data.title}}
                </div>
                <div class="equipment__content" v-html="this.data.description">
                </div>
                <div class="equipment__row">
                    <div class="equipment__column">
                        <div class="equipment__image">
                            <img :src="this.data.preview_image" alt="">
                        </div>
                    </div>
                    <div class="equipment__column">

                        <div class="equipment__item"
                             v-for="(item, index) in this.data.first_section_description"
                        >
                            <div class="equipment__item-title">
                                <h4>
                                    <span>0{{index+1}}</span>{{item.input}}
                                </h4>
                            </div>
                            <div class="equipment__item-text">
                                <p>
                                    {{item.textarea}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="supervision">
            <div class="container">
                <div class="supervision__row">
                    <div class="supervision__title">
                        <h2>
                            {{this.data.second_section_title}}
                        </h2>
                    </div>
                    <div class="supervision__image">
                        <img
                            lazy
                            v-lazy="{
                              src: this.data.second_section_image,
                              error: 'url',
                            }"
                           alt="">
                    </div>
                    <div class="supervision__text" v-html="this.data.second_section_description">
                    </div>
                </div>
            </div>
        </div>

        <div class="supervisionneeded">
            <div class="container">
                <div class="supervisionneeded__row">
                    <div class="supervisionneeded__title">
                        <h3>
                            {{this.data.third_section_title}}
                        </h3>
                    </div>
                    <div class="supervisionneeded__content" v-html="this.data.third_section_description">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "secondTemplate",
    props: ['data'],
    mounted() {
        console.log(this.data)
    }
}
</script>

<style lang="scss" scoped>
.equipment__image{
    min-height: 681px;
    min-width: 530px;
    img{

    }
}
.supervision__image{
    height: 532px;

}
</style>
