<template>
    <div class="project-widget1" @click="openSlider(this.data.file)">
        <div class="container">
            <div class="row">
                <div class="project-widget1__container">
                    <img class="project-widget1__container-img"
                         alt=""
                         lazy
                         v-lazy="{
                          src: this.data.file,
                          error: 'url',
                        }"
                    >
                </div>
                <p v-if="this.data.text && this.data.text.length > 0" class="project-widget1-text">
                    {{this.data.text}}
                </p>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: "Widget1",
    props: ['data', 'dataKey'],
    methods: {
        openSlider(file){
            this.$emit('openSlider', file);
        }
    }
}
</script>

<style scoped>

</style>
