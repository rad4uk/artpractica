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
                     @click="setTabInteriorPackage(this.interiorPackageText)"
                     :class="{active: checkTab('InteriorPackage')}"
                >
                    <p class="tabs__item-text">
                        {{this.interiorPackageText}}
                    </p>
                </div>
                <div class="tabs__item"
                     @click="setTabDesignEngineering(this.designEngineeringText)"
                     :class="{active: checkTab('DesignEngineering')}"
                >
                    <p class="tabs__item-text">
                        {{this.designEngineeringText}}
                    </p>
                </div>
                <div class="tabs__item" @click="setTabAtelier(this.atelierText)"
                         :class="{active: checkTab('Atelier')}">
                        <p class="tabs__item-text">
                            {{ this.atelierText }}
                        </p>
                    </div>


            </div>
        </div>
    </div>

    <interior-package
        v-if="checkTab('InteriorPackage')"
    ></interior-package>
    <design-engineering
        v-if="checkTab('DesignEngineering')"
    ></design-engineering>
    <atelier
        v-if="checkTab('Atelier')"
    ></atelier>


<!--    <InteriorPackage-->
<!--        v-if="checkTab('InteriorPackage')"-->
<!--    >-->
<!--        <template v-slot:designTextComponent>-->
<!--            <DesignText>-->
<!--                <template v-slot:title>-->
<!--                    <h1>-->
<!--                        ДИЗАЙН ПРОЕКТИРОВАНИЕ-->
<!--                    </h1>-->
<!--                </template>-->

<!--                <template v-slot:text>-->
<!--                    <p>-->
<!--                        Помните русскую пословицу «Не место красит человека, а человек – место»?-->
<!--                    </p>-->
<!--                    <p>-->
<!--                        Проработав с профессионалами своего дела, людьми, объединенными вот уже более 15 лет общей специальностью, креативным мышлением, творческим началом, готовы заверить: такой принцип может быть зеркален.-->
<!--                    </p>-->
<!--                    <p>-->
<!--                        История ArtPractica о том, как место повлияло на жизни многих людей. Как были задуманы и воплощены сотни красивых и функциональных проектов, соединивших владельцев с их мечтами.-->
<!--                    </p>-->
<!--                    <p>-->
<!--                        Наша команда предлагает индивидуальный сервис для создания дизайн-проекта любой сложности, формирования образа дома, который вы хотите полюбить. И мы готовы приложить все усилия, чтобы это была любовь с первого взгляда.-->
<!--                    </p>-->
<!--                </template>-->


<!--            </DesignText>-->
<!--        </template>-->


<!--    </InteriorPackage>-->
<!--    <DesignEngineering-->
<!--        v-if="checkTab('DesignEngineering')"-->
<!--    >-->
<!--        <template v-slot:designTextComponent>-->
<!--            <DesignText>-->
<!--                <template v-slot:title>-->
<!--                    <h1>-->
<!--                        КОМПЛЕКТАЦИЯ ИНТЕРЬЕРА-->
<!--                    </h1>-->
<!--                </template>-->

<!--                <template v-slot:text>-->
<!--                    <p>-->
<!--                        Обратившись в компанию АкРгасиса вы получаете весь спектр услуг в одном месте. Стильный и продуманный дизайн интерьера ‚ качественные ремонтно - отделочные работы,полная комлетация интерьра. Она существенно экономит время заказчика и дизайнера, гарантирует, что клиенту понравится работа. Вам больше не придется тратить свое время на подбор мебели. Мы возьмем на себя все обязанности по оформлению квартир, домов или студий под ключ.-->
<!--                    </p>-->
<!--                </template>-->
<!--            </DesignText>-->
<!--        </template>-->
<!--    </DesignEngineering>-->
</template>

<script>
import DesignEngineering from "./DesignEngineering.vue";
import InteriorPackage from "./InteriorPackage.vue";
import Atelier from "./Atelier.vue";
import DesignText from "./DesignText.vue";
export default {
    name: "Tab",
    components: {
        DesignEngineering,
        InteriorPackage,
        Atelier,
        DesignText
    },
    data: () => {
      return {
          tabType: 'InteriorPackage',
          tabsDesktopIsActive: false,
          interiorPackageText: 'Дизайн проектирование',
          designEngineeringText: 'Комплектация интерьера',
          atelierText: 'Ателье авторской мебели',
          tabTitle: 'Дизайн проектирование'
      }
    },
    computed: {
        // геттер вычисляемого значения
        currentTabType: function () {
            return this.tabType
        }
    },
    methods: {
        checkTab(tabType){
            return this.currentTabType === tabType
        },
        setTabInteriorPackage(tabTile){
            this.tabsDesktopIsActive = false
            this.tabTitle = tabTile
            this.tabType = 'InteriorPackage'
        },
        setTabDesignEngineering(tabTile){
            this.tabsDesktopIsActive = false
            this.tabTitle = tabTile
            this.tabType = 'DesignEngineering'
        },
        setTabAtelier(tabTile){
            this.tabsDesktopIsActive = false
            this.tabTitle = tabTile
            this.tabType = 'Atelier'
        },
        activeTabsMenu(){
            this.tabsDesktopIsActive = !this.tabsDesktopIsActive
        }

    }
}
</script>

<style>
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
        border: 1px solid rgba(189, 170, 135, 1);
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
