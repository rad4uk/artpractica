<template>
    <a :href="item.slug" class="project__item">
        <div class="project__text">
            <p class="project__title">{{ item.title }}</p>
            <p class="project__subtitle">{{ item.square + 'M2' }}</p>
        </div>
        <div class="project__image">
            <picture>
<!--                <source v-if="this.item.preview_image.small" :srcset="this.item.preview_image.small" media="(max-width: 576px)"/>-->
<!--                <source v-if="this.item.preview_image.medium" :srcset="this.item.preview_image.medium" media="(max-width: 768px)"/>-->
<!--                <source v-if="this.item.preview_image.large" :srcset="this.item.preview_image.large" media="(max-width: 992px)"/>-->
                <img
                    lazy
                    v-lazy="{
                      src: this.item.preview_image.default,
                      error: 'http://127.0.0.1/storage/images/project/img_49.png',
                    }"
                    alt=""
                >
            </picture>

        </div>
    </a>

</template>

<script>
export default {
    name: "ProjectItem",
    props: ['item'],
    mounted() {
        console.log(this.item)
    }
}
</script>

<style lang="scss" scoped>
.project__item {
    max-height: 650px;
}

.project__image {
    img {
        object-fit: cover;
    }
}
</style>
