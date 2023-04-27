<template>
    <form id="form" @click.stop>
        <div class="feedback__form-item"
             :class="{ 'has-error': nameField.error && !nameField.value}"
        >
            <input type="text" name="name" placeholder="имя" id="feedback__form-id"
                   v-model="nameField.value"
            >
        </div>

        <div class="feedback__form-item"
             :class="{ 'has-error': phoneField.error && !phoneField.value }"
        >
            <input type="text" placeholder="телефон" id="feedback__form-phone"
                   v-model="phoneField.value"
                   ref="field"
            >
        </div>
        <button type="submit" class="buttonShadow"
                @click.prevent="this.sendConsultation()"
        >ОБРАТНЫЙ ЗВОНОК</button>
    </form>
    <div id="myPopup"
         :class="[this.getIsOpenConsultationPopup && isMessage ? 'fade-in' : 'fade-out', 'popup']"
         @click.self="closePopUp()"
    >
        <div class="popup__container">
            <div class="popup-message">
                {{this.message}}
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Inputmask from "inputmask";

export default {
    name: "FormComponent",
    props: {
        mask: {type: String},
    },
    mounted() {
        this.maskedField = new Inputmask(this.maskRussia);
        this.maskedField.mask(this.$refs.field);
    },
    data: () => {
        return {
            isOpenPopUp: false,
            maskRussia: "+7 (999) 999-99-99",
            maskedField: "",
            message: '',
            isMessage: false,
            errors: [],
            nameField: {
                value: '',
                error: false
            },
            phoneField: {
                value: '',
                error: false
            }
        }
    },
    methods: {
        submitForm() {
            if (!this.nameField.value) {
                this.nameField.error = true
            }
            if (!this.phoneField.value) {
                this.phoneField.error = true
            }
        },
        closePopUp() {
            this.isOpenPopUp = false
        },
        async sendConsultation() {
            this.submitForm()
            if (!this.nameField.value || !this.phoneField.value) {
                return;
            }
            this.isOpenPopUp = true
            let formData = new FormData();
            formData.append('name', this.nameField.value)
            formData.append('phone', this.phoneField.value)

            try {
                const response = await axios.post('/consultation/send', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                console.log(response)
                if (response.status === 201) {
                    this.message = 'Ваша заявка отправленна, в ближайшее время с вами свяжется наш специалист.'
                    this.isMessage = true
                }
            } catch (error) {
                this.message = error.response.data
                this.isMessage = true
            }
        },
    },
    computed: {
        getIsOpenConsultationPopup: function (){
            return this.isOpenPopUp
        }
    }
}
</script>

<style scoped>
.popup-message{
    text-align: center;
    font-family: "Montserrat";
    font-weight: normal;
    font-size: 14px;
    line-height: 16px;
    color: #FFFFFF;
}
.popup__container{
    width: 30%;
    height: 200px;
    display: flex;
    justify-content: center;
    align-items: center;
    background: rgb(16, 14, 12);
    border-radius: 10px;
    color: #fff;
}
.has-error {
    border-color: #AE4834 !important;
    animation: shake 0.5s;
}
.has-error input::placeholder, .has-error textarea::placeholder{
    color: #AE4834;
}
@keyframes shake {
    0% { transform: translateX(0); }
    25% { transform: translateX(-10px); }
    50% { transform: translateX(10px); }
    75% { transform: translateX(-10px); }
    100% { transform: translateX(0); }
}
.error {
    color: red;
    font-size: 12px;
}

.feedback__form-textarea{
    border: 1px solid rgba(165, 165, 165, 0.47);
    padding: 5px;
    border-radius: 5px;
}




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
