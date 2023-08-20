<template>
    <div class="discuss">
        <div class="discuss__screen">
            <img lazy v-lazy="{ src: this.image_path }" alt="">
        </div>
        <div class="discuss__wrapper">
            <div class="discuss__content">
                <div class="discuss__title">
                    <p>Хотите обсудить проект?</p>
                    <p>Давайте начнём</p>
                </div>
                <button class="discuss__button" @click="openPopUp()">Оставить заявку</button>
            </div>

        </div>
    </div>
    <ConsultationPopupComponent></ConsultationPopupComponent>
</template>

<script>
import { homeStore } from "../../../store/frontend/homeStore.js";
import ConsultationPopupComponent from "../ConsultationPopupComponent.vue";
export default {
    name: "DiscussComponent",
    props: ['image_path'],
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
