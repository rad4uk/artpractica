<template>
    <div class="project-widget2">
        <div class="container">
            <div class="row">
                <div class="project-widget2__container">
                    <div v-for="(file, index) in this.data.files"
                         :key="index"
                         class="project-widget2-item"
                         @click="openSlider(file)"
                    >
                        <img :src="file" alt="" class="project-widget2__container-img">
                    </div>
                </div>
                <p v-if="this.data.text && this.data.text.length > 0" class="project-widget2-text">
                    {{this.data.text}}
                </p>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: "Widget2",
    props: ['data'],
    methods: {
        openSlider(file){
            this.$emit('openSlider', file);
        }
    }
}
</script>

<style scoped>

</style>
