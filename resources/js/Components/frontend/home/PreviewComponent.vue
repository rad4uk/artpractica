<template>
    <div class="screen">
        <div class="screen__image">
            <picture>
                <img src="/images/mainImg.webp" alt="">
            </picture>
        </div>
        <div class="screen__wrapper">
            <div class="screen__body">
                <p class="screen__subtitle">Мы с вами от зарождения проекта до его реализации</p>
                <h1 class="screen__title">СТУДИЯ <br>ДИЗАЙнА ИНТЕРЬЕРА ПОЛНОГО ЦИКЛА</h1>
                <div class="screen__button">
                    <button @click="openPopUp()">
                        ОБСУДИТЬ ПРОЕКТ
                    </button>
                </div>
            </div>
        </div>
    </div>
    <ConsultationPopupComponent></ConsultationPopupComponent>

</template>

<script>
import { homeStore } from "../../../store/frontemd/homeStore.js";
import ConsultationPopupComponent from "../ConsultationPopupComponent.vue";
export default {
    name: "PreviewComponent",
    components: {
        ConsultationPopupComponent
    },

    setup(){
        const useHomeStore = homeStore();
        return {useHomeStore}
    },
    methods: {
        openPopUp(){
            this.useHomeStore.openConsultationPopup()
        }
    }
}
</script>

<style scoped>

</style>
