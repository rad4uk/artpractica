<template>
    <!--    <div>-->
    <!--        <slot name="designTextComponent"></slot>-->

    <div class="designtext">
        <div class="container">
            <div class="designtext__row">
                <div class="designtext__title">
                    <slot name="title">
                        <h1>{{ this.data.title }}</h1>
                    </slot>
                </div>

                <div class="designtext__text" v-html="this.data.description">
                </div>

                <div class="sectionimage__block">
                    <div class="sectionimage__image">
                        <img :src="this.data.preview_image" :alt="this.data.title">
                    </div>
                </div>
                <a href="#form" class="designtext__button">ОСТАВИТЬ ЗАЯВКУ</a>
            </div>
        </div>
    </div>

    <div class="stages" v-if="this.data.first_section_description.length > 0">
        <div class="container">
            <div class="stages__title">
                <h3>ЭТАПЫ РАБОТЫ НАД ДИЗАЙН ПРОЕКТОМ</h3>
            </div>
            <div class="row">
                <div class="stages__column">
                    <div
                        v-for="(item, idx) in this.first_column_data"
                        :key="idx"
                        class="stages__column-item stages-item">
                        <div class="stages-item-title">

                            <p><span>0{{ idx + 1 }}</span>{{ item.input }}</p>
                        </div>
                        <div class="stages-item-content">
                            <p>{{ item.textarea }}</p>
                        </div>
                    </div>

                </div>

                <div class="stages__column" v-if="this.second_column_data.length > 0">
                    <div
                        v-for="(item, idx) in this.second_column_data"
                        :key="idx"
                        class="stages__column-item stages-item">
                        <div class="stages-item-title">
                            <p><span>0{{ this.first_column_data_length + idx }}</span>{{ item.input }}</p>
                        </div>
                        <div class="stages-item-content">
                            <p>{{ item.textarea }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "firstTemplate",
    props: ['data'],
    data: () => {
        return {
            first_column_data_length: 0,
            first_column_data: [],
            second_column_data: [],
        }
    },
    mounted() {
        if (this.data.first_section_description.length > 0) {
            const length = this.data.first_section_description.length;
            const part = Math.ceil(length / 2);
            this.first_column_data = this.data.first_section_description.slice(0, part); // первые 6 элементов
            this.second_column_data = this.data.first_section_description.slice(length - part); // оставшиеся 5 элементов
            this.first_column_data_length = part + 1;
        }
    }
}
</script>

<style scoped>

</style>
