<template>
    <div class="tabs">
        <div class="container">
            <div class="selected-item" @click="this.activeTabsMenu()">
                <p class="selected-item-title">{{ this.activeTitle }}</p>
                <p :class="{'arrow-down': !tabsDesktopIsActive, 'arrow-up': tabsDesktopIsActive}"></p>
            </div>
            <div class="tabs__row"
            >
                <ul class="tabs__list"
                    :class="{'tabs-active': tabsDesktopIsActive, 'tabs-out': !tabsDesktopIsActive}"
                >
                    <li
                        v-for="(cat, idx) in this.categories"
                        :key="idx"
                        :class="[{'active': this.category.id === cat.id}, 'tabs__item']">
                            <a
                                v-if="cat.id !== this.category.id"
                                :href="cat.fullSlug"
                            >
                                {{cat.id === 1 ?  this.portfolioTitle : cat.title}}
                            </a>
                            <p v-else>
                                {{cat.id === 1 ?  this.portfolioTitle : cat.title}}
                            </p>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Tabs",
    props: ['categories', 'category'],
    data: () => {
      return {
          portfolioTitle: 'Все объекты',
          tabsDesktopIsActive: false,
          activeTitle: '',
      }
    },
    mounted() {
        console.log(this.categories)
        console.log(this.category)
        this.activeTitle = this.category.title
        this.activeTitle = this.category.id === 1 ?  this.portfolioTitle : this.category.title
    },
    methods: {
        activeTabsMenu() {
            this.tabsDesktopIsActive = !this.tabsDesktopIsActive
        }
    }
}
</script>

<style lang="scss" scoped>
@import "@root/sass/frontend/variables.scss";

.arrow-down{
    display: none;
    @media (max-width: $middle-media) {
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
    @media (max-width: $middle-media) {
        display: block;
        width: 0;
        height: 0;
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-bottom: 10px solid $mobile-border-color;

    }

}

.selected-item{
    display: none;
    @media (max-width: $middle-media) {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        border: 1px solid #AE4834;
        padding: 9px 11px;
        &-title{
            width: 100%;
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 400;
            color: $color-white;
            @include adaptiv-font(18, 12);
            @include adaptiv-line-height(22, 15);
        }
    }
}

.tabs__list{
    @media (max-width: $middle-media) {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        border: 1px solid #AE4834;
        border-top: 0;
        padding: 9px 11px;
        gap: 10px;
        .tabs__item.active{
            opacity: 0.7;
        }
        .tabs__item{
            padding: 0;
            @include adaptiv-font(18, 12);
            @include adaptiv-line-height(22, 15);
        }
    }
}
.tabs__row{
    position: relative;
}
@media (max-width: $middle-media) {
    /*.tabs-active .active, .tabs-out .active{*/
    /*    display: none;*/
    /*}*/
    .tabs-active, .tabs-out {
        position: absolute;
        left: 0;
        right: 0;
        z-index: 3;
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

</style>
