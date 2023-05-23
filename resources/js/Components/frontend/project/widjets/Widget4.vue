<template>
    <div v-if="this.data.title" class="project-widget4">
        <div class="container">
            <div class="row">
                <h3 class="project-widget4-title">{{this.data.title}}</h3>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Widget4",
    props: ['data']
}
</script>

<style scoped>

</style>
