<template>
    <div class="project-widget3">
        <div class="container">
            <div class="row">
                <div class="project-widget3-container">
                    <div class="project-widget3__column"
                         v-for="(file, index) in this.data.files"
                         :key="index"
                         @click="openSlider(file)"
                    >
                        <img class="project-widget3__column-image"
                             alt=""
                             v-lazy="{
                              src: file,
                              error: 'url',
                            }"
                        >
                    </div>
                </div>
                <p v-if="this.data.text && this.data.text.length > 0" class="project-widget3-text">
                    {{ this.data.text }}
                </p>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: "Widget3",
    props: ['data'],
    methods: {
        openSlider(file) {
            this.$emit('openSlider', file);
        }
    }
}
</script>

<style scoped>

</style>
