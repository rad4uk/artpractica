<template>
    <a :href="item.route" class="project__item">
        <div class="project__text">
            <p class="project__title">{{ item.title }}</p>
            <p class="project__subtitle">{{ item.square + 'M2' }}</p>
        </div>
        <div class="project__image">
            <picture>
                <source v-if="this.item.preview_image.small" :srcset="this.item.preview_image.small" media="(max-width: 370px)"/>
                <source v-if="this.item.preview_image.medium" :srcset="this.item.preview_image.medium" media="(max-width: 520px)"/>
                <source v-if="this.item.preview_image.large" :srcset="this.item.preview_image.large" media="(max-width: 768px)"/>
                <source v-if="this.item.preview_image.big" :srcset="this.item.preview_image.big" media="(max-width: 992px)"/>
                <img
                    lazy
                    v-lazy="{
                      src: this.item.preview_image.default,
                      error: 'error',
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
}
</script>

<style lang="scss" scoped>
//.project__item {
//    max-height: 650px;
//}
//
//.project__image {
//    img {
//        object-fit: cover;
//    }
//}
</style>
