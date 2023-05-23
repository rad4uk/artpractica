<template>
    <header class="header" :class="{ active: headerScrollActive }">
        <div class="container">
            <div class="header__row">

                <div class="header__logo">
                    <a href="/">
<!--                        <picture>-->
<!--                            <source :srcset="this.images[0]" media="(max-width: 520px)">-->
<!--                            <source :srcset="this.images[1]" media="(max-width: 768px)">-->
<!--                            <img :src="this.images[2]" alt="">-->
<!--                        </picture>-->
                    </a>
                </div>
                <div class="header__nav-mobile-nav" :class="{'burger-active': menuIsActive}" @click="this.openMenu()">
                    <div class="header__nav-mobile-line"></div>
                    <div class="header__nav-mobile-line"></div>
                    <div class="header__nav-mobile-line"></div>
                </div>
                <nav class="header__nav" :class="{'nav-active': menuIsActive}">
                    <ul class="header__nav-list">
                        <li v-if="!this.portfolio.class">
                            <a :href="this.portfolio.slug" :class="{'active': this.portfolio.class}">портфолио</a>
                        </li>
                        <li v-else>
                            портфолио
                        </li>
                        <li v-if="!this.services.class">
                            <a :href="this.services.slug" :class="{'active': this.services.class}">услуги</a>
                        </li>
                        <li v-else>
                            услуги
                        </li>
                        <li v-if="!this.about.class">
                            <a :href="this.about.slug" :class="{'active': this.about.class}">о нас</a>
                        </li>
                        <li v-else>
                            о нас
                        </li>
                        <li v-if="!this.contact.class">
                            <a :href="this.contact.slug" :class="{'active': this.contact.class}">контакты</a>
                        </li>
                        <li v-else>
                            контакты
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
    </header>
</template>

<script>
export default {
    name: "HeaderComponent",
    props: ['portfolio', 'services', 'about', 'contact', 'images'],
    data: () => {
        return {
            headerScrollActive: false,
            menuIsActive: false
        }
    },
    mounted() {
        window.addEventListener('scroll', this.handleScroll);
    },
    methods: {
        openMenu(){
            this.menuIsActive = !this.menuIsActive
        },
        handleScroll() {
            if (window.scrollY > 0) {
                this.headerScrollActive = true;
            } else {
                this.headerScrollActive = false;
            }
        },
    },

}
</script>

<style lang="scss" scoped>
@import "@root/sass/frontend/variables.scss";
@media (max-width: $tablet-media) {
    .header.active{
        background-color: rgba(33, 33, 33, 0.4);
        transition: background-color 0.5s ease-in-out;
    }

    .header.active .header__nav-mobile-nav .header__nav-mobile-line{
        background-color: #AE4834;
        transition: background-color 0.5s ease-in-out;
    }
}


</style>
