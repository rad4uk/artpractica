<template>
    <header class="header">
        <div class="container">
            <div class="header__row">

                <div class="header__logo">
                    <a href="/">
                        <picture>
                            <source srcset="/images/logo-88-24.png" media="(max-width: 768px)">
                            <img src="/images/logo-172-47.png" alt="">
                        </picture>
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
    props: ['portfolio', 'services', 'about', 'contact'],
    data: () => {
        return {
            menuIsActive: false
        }
    },
    mounted() {
      console.log(this.portfolio)
    },
    methods: {
        openMenu(){
            this.menuIsActive = !this.menuIsActive
        }
    }
}
</script>

<style lang="scss" scoped>
//#app{
//    position: relative;
//}

</style>
