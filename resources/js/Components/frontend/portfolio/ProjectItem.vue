<template>
    <a :href="item.slug" class="project__item">
        <div class="project__text">
            <p class="project__title">{{item.title}}</p>
            <p class="project__subtitle">78M2</p>
        </div>
        <div class="project__image">
            <img
                lazy
                v-lazy="{
                  src: item.preview_image,
                  error: 'url',
                }"
                alt="">

        </div>
    </a>

</template>

<script>
export default {
    name: "ProjectItem",
    props: ['item']
}
</script>

<style scoped>

</style>
