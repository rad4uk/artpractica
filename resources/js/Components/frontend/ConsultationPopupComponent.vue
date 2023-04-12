<template>
    <div id="myPopup"
         :class="[this.getIsOpenConsultationPopup() ? 'fade-in' : 'fade-out', 'popup']"
         @click.self="closePopUp()"
    >
        <consultation-form @click.stop :class="'consultationPopup'"></consultation-form>
    </div>
</template>

<script>
import {homeStore} from "../../store/frontemd/homeStore.js";
import ConsultationForm from "./ConsultationForm.vue";
export default {
    name: "ConsultationPopupComponent",
    components: {
        ConsultationForm
    },
    setup(){
        const useHomeStore = homeStore();
        return {useHomeStore}
    },
    data: () => {
        return {
            isOpenPopUp: false
        }
    },
    methods: {
        closePopUp() {
            this.useHomeStore.closeConsultationPopup()
        },
        getIsOpenConsultationPopup(){
            return this.useHomeStore.getIsOpenConsultationPopup
        }
    }
}
</script>

<style scoped>
.consultationPopup{
    display: flex;
    align-items: center;
    justify-content: center;
    max-width: 436px;
}
.feedback__row{
    flex: 0 1 auto;
}
.feedback-form {
    padding: 15px;
}

.consultation-form .feedback__form-item:first-child {
    margin-top: 0;
}

/* Скрыть всплывающее окно */
.popup {
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    visibility: hidden;
    position: fixed;
    z-index: 5;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
    transition: opacity 0.5s ease, visibility 0s linear 0.5s;
}

.popup .feedback__row {
    border-radius: 10px;
    background: rgb(16, 14, 12);
    padding: 20px;
}

/* Стиль для кнопки, которая открывает всплывающее окно */
#myButton {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

/* Стиль для крестика закрытия окна */
.close {
    position: absolute;
    top: 10px;
    right: 20px;
    font-size: 28px;
    font-weight: bold;
    color: #fff;
    cursor: pointer;
}

/* Стиль для текста внутри всплывающего окна */
.popup p {
    font-size: 24px;
    font-weight: bold;
    color: #fff;
    text-align: center;
    margin-top: 20%;
}

/* Анимация для открытия всплывающего окна */
.popup.fade-in {
    opacity: 1;
    visibility: visible;
    transition: opacity 0.5s ease, visibility 0s linear 0s;
}

/* Анимация для закрытия всплывающего окна */
.popup.fade-out {
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.5s ease, visibility 0s linear 0.5s;
}

/* Отображать всплывающее окно при нажатии на кнопку */
#myButton:hover + #myPopup {
    display: block;
    animation: fadeIn 0.5s ease;
}

/* Анимация для открытия всплывающего окна */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}
</style>
