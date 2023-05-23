<template>
    <div class="project-widget3">
        <div class="container">
            <div class="row">
                <div class="project-widget3-container">
                    <div v-for="(file, index) in this.data.files"
                         :key="index"
                         class="project-widget3__column"
                    >
                        <img :src="file" alt=""
                             class="project-widget3__column-image">
                    </div>
                </div>
                <p v-if="this.data.text && this.data.text.length > 0" class="project-widget3-text">
                    {{this.data.text}}
                </p>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: "Widget3",
    props: ['data']
}
</script>

<style scoped>

</style>
