<template>
    <div v-if="this.data.file" class="project-widget5">
        <div class="container">
            <div class="row">
                <div class="project-widget5__container">
                    <img :src="this.data.file" alt="" class="project-widget5__container-img">
                </div>
                <p v-if="this.data.text && this.data.text.length > 0" class="project-widget5-text">
                    {{this.data.text}}
                </p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Widget5",
    props: ['data']
}
</script>

<style scoped>

</style>
