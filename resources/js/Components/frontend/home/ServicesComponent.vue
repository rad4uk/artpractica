<template>
    <div class="services">
        <div class="container">
            <div class="services__title">
                <h1>{{this.activeService.title}}</h1>
            </div>
            <div class="services-select-wrapper">
                <div class="services-selected-item" @click="this.activeTabsMenu()">
                    <p>{{this.activeService.title}}</p>
                    <p :class="{'arrow-down': !menuIsActive, 'arrow-up': menuIsActive}"></p>
                </div>
                <ul class="services__select"
                    :class="{'tabs-active': menuIsActive, 'tabs-out': !menuIsActive}"
                >
                    <li
                        :class="[{active: index === this.activeIndex}, 'services__select-item']"
                        v-for="(service, index) in this.services"
                        :key="index"
                        @click="this.setService(index, service)"
                    >
                        {{service.title}}
                    </li>
                </ul>
            </div>

            <div class="services__row">
                <div v-for="(service, index) in this.services"
                     :key="index"
                     :class="[{active: index === this.activeIndex}, 'services__item']"
                >
                    <div class="services__subtitle">
                        <p>{{service.title}}</p>
                    </div>
                    <div class="services__image">

                        <picture>
                            <source v-if="service.image['small']" :srcset="service.image['small']" media="(max-width: 330px)"/>
                            <source v-if="service.image['medium']" :srcset="service.image['medium']" media="(max-width: 520px)"/>
                            <source v-if="service.image['large']" :srcset="service.image['large']" media="(max-width: 768px)"/>
                            <img
                                lazy
                                v-lazy="{
                              src: service.image['default'],
                              error: 'url',
                            }"
                                :alt="service.title">
                        </picture>
                    </div>
                    <div class="services__content">
                        <div v-html="service.description"></div>
                        <div class="services__more">
                            <a :href="service.slug">подробнее</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ServicesComponent",
    props: ['services'],
    data: () => {
        return {
            activeIndex: 0,
            activeService: '',
            menuIsActive: false,
        }
    },
    mounted() {
        // console.log(this.services)
      this.activeService = this.services[0]
    },
    methods: {
        activeTabsMenu() {
            this.menuIsActive = !this.menuIsActive
        },
        setService(index, service){
            this.activeIndex = index
            this.activeService = service
            this.menuIsActive = false
        }
    }
}
</script>

<style lang="scss" scoped>
@import "@root/sass/frontend/variables.scss";

.services__title{
    @media (max-width: $tablet-media) {
        display: none;
    }
}
.services__row{
    @media (max-width: $tablet-media) {
        .services__item {
            display: none;
        }

        .services__item.active{
            display: flex;
        }

        .services__subtitle{
            display: none;
        }
    }

}


.services-select-wrapper{
    display: flex;
    flex-direction: column;
    position: relative;
    margin-bottom: 20px;
    @media (min-width: $tablet-media) {
        display: none;
    }
    .services-selected-item{
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 9px 11px;
        border: 1px solid #AE4834;
        p{
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 300;
            font-size: 12px;
            line-height: 15px;
            letter-spacing: 0.06em;
            color: #FFFDFC;
        }
    }

    .services {
        &__select {
            border: 1px solid #AE4834;
            border-top: 0;
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 9px 11px;
            &-item {
                font-family: 'Montserrat';
                font-style: normal;
                font-weight: 300;
                font-size: 12px;
                line-height: 15px;
                letter-spacing: 0.06em;
                color: #FFFDFC;
            }
        }
    }
}


//.tabs__item-text {
//    opacity: 0.6;
//}
//
//.mobile-active .active {
//    opacity: 1;
//}
//
//.active .tabs__item-text {
//    opacity: 1;
//}

@media (max-width: 768px) {
    .services__select-item.active{
        opacity: 0.7;
    }
    .tabs-active, .tabs-out {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        z-index: 1;
        background-color: #100E0C;
    }
    .tabs-active {
        display: flex;
        animation: fadeInUp .3s;
    }
    .tabs-out {
        display: flex;
        animation: fadeDown .3s;
        animation-fill-mode: forwards;

    }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        -webkit-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
    }

    to {
        opacity: 1;
        -webkit-transform: none;
        transform: none;
    }
}

@keyframes fadeDown {
    from {
        opacity: 1;
        -webkit-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
    }

    to {
        opacity: 0;
        -webkit-transform: none;
        transform: none;
    }
}

.arrow-down{
    display: none;
    @media (max-width: $tablet-media) {
        display: block;
        width: 0;
        height: 0;
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-top: 10px solid $mobile-border-color;

    }

}
.arrow-up{
    display: none;
    @media (max-width: $tablet-media) {
        display: block;
        width: 0;
        height: 0;
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-bottom: 10px solid $mobile-border-color;

    }

}

</style>
