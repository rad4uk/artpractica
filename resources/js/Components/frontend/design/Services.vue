<template>

    <div class="tabs">
        <div class="container">
            <div class="tabs__title mobile-active" @click="this.activeTabsMenu()">
                <p class="tabs__item-text active">
                    {{this.tabTitle}}
                </p>
                <p :class="{'arrow-down': !tabsDesktopIsActive, 'arrow-up': tabsDesktopIsActive}"></p>
            </div>
            <div class="tabs__row"
                :class="{'tabs-active': tabsDesktopIsActive, 'tabs-out': !tabsDesktopIsActive}"
            >
                <div class="tabs__item"
                     v-for="(item, index) in this.services"
                     @click="selectedTab(item)"
                     :key="index"
                     :class="{active: checkTab(item.slug, item.name)}"
                >
                    <p class="tabs__item-text">
                        {{item.title}}
                    </p>
                </div>



<!--                <div class="tabs__item"-->
<!--                     @click="setTabInteriorPackage(this.interiorPackageText)"-->
<!--                     :class="{active: checkTab('InteriorPackage')}"-->
<!--                >-->
<!--                    <p class="tabs__item-text">-->
<!--                        {{this.interiorPackageText}}-->
<!--                    </p>-->
<!--                </div>-->
<!--                <div class="tabs__item"-->
<!--                     @click="setTabDesignEngineering(this.designEngineeringText)"-->
<!--                     :class="{active: checkTab('DesignEngineering')}"-->
<!--                >-->
<!--                    <p class="tabs__item-text">-->
<!--                        {{this.designEngineeringText}}-->
<!--                    </p>-->
<!--                </div>-->
<!--                <div class="tabs__item" @click="setTabAtelier(this.atelierText)"-->
<!--                         :class="{active: checkTab('Atelier')}">-->
<!--                    <p class="tabs__item-text">-->
<!--                        {{ this.atelierText }}-->
<!--                    </p>-->
<!--                </div>-->
            </div>
        </div>
    </div>


    <component :data='this.checkItem' :is="this.checkItem.name"></component>

</template>

<script>
import firstTemplate from "./firstTemplate.vue";
import secondTemplate from "./secondTemplate.vue";
import thirdTemplate from "./thirdTemplate.vue";
import DesignText from "./DesignText.vue";
export default {
    name: "Tab",
    components: {
        firstTemplate,
        secondTemplate,
        thirdTemplate,
        DesignText
    },
    props: [
      'service',
      'services'
    ],
    beforeMount() {
      this.selectedTab(this.service)
    },
    data: () => {
      return {
          checkItem: null,
          tabType: '',
          tabsDesktopIsActive: false,
          tabTitle: 'Дизайн проектирование'
      }
    },
    computed: {
        currentTabType: function () {
            return this.tabType
        }
    },
    methods: {
        checkTab(tabType){
            return this.currentTabType === tabType
        },
        selectedTab(item){
            this.tabsDesktopIsActive = false
            this.tabTitle = item.name
            this.tabType = item.slug
            this.checkItem = item
        },

        activeTabsMenu(){
            this.tabsDesktopIsActive = !this.tabsDesktopIsActive
        }

    }
}
</script>

<style lang="scss">
@import "@root/sass/frontend/variables.scss";

.container{
    position: relative;
}
.tabs__item-text{
    opacity: 0.6;
}
.mobile-active .active{
    opacity: 1;
}

.active .tabs__item-text {
    opacity: 1;
}

@media (max-width: 768px) {
    /*.tabs-active .active, .tabs-out .active{*/
    /*    display: none;*/
    /*}*/
    .tabs-active, .tabs-out{
        position: absolute;
        left: 20px;
        right: 20px;
        z-index: 1;
        background-color: #100E0C;
    }
    .tabs__row{
        /*display: none;*/
        border: 1px solid $mobile-border-color;
        border-top: 0;
    }
    .tabs-active{
        display: flex;
        animation: fadeInUp .3s;
    }
    .tabs-out{
        display: flex;
        animation: fadeDown .3s;
        animation-fill-mode:forwards;

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
