<template>
    <div class="feedback__row">
        <div class="feedback__item feedback-form">
            <div class="feedback__form">
                <form method="post" id="form" class="consultation-form">
                    <div class="feedback__form-item" :class="{ 'has-error': nameField.error && !nameField.value}">
                        <input type="text" name="name" id="feedback__form-id" v-model="nameField.value" placeholder="имя">
                    </div>

                    <div class="feedback__form-item" :class="{ 'has-error': phoneField.error && !phoneField.value }">
                        <input type="text" id="feedback__form-phone"
                               v-model="phoneField.value"
                               ref="field"
                               placeholder="телефон"
                        >
                    </div>
                    <div class="feedback__form-item feedback__form-textarea">
                        <textarea id="feedback__form-text" v-model="textField.value" placeholder="комментарий" rows="3"></textarea>
                    </div>
                    <button type="submit" class="buttonShadow"
                            @click.prevent="this.sendConsultation()"
                    >ОБРАТНЫЙ ЗВОНОК</button>

                    <div v-show="isMessage" class="popup-message">
                        <p class="success">
                            {{this.message}}
                        </p>
                    </div>
                </form>
                <div class="feedback__form-line">
                    <a href="https://vk.com/art_practica_36" target="_blank" class="feedback__inst">VKONTAKTE</a>
                    <a href="mailto: artpractica@mail.ru" class="feedback__email">artpractica@mail.ru</a>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import axios from "axios";
import Inputmask from "inputmask";

export default {
    name: "ConsultationForm",
    props: {
        mask: {type: String},
    },
    data: () => {
        return {
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
            },
            textField: {
                value: '',
                error: false
            },
        }
    },
    mounted() {
        this.maskedField = new Inputmask(this.maskRussia);
        this.maskedField.mask(this.$refs.field);
    },
    methods: {
        submitForm() {
            if (!this.nameField.value){
                this.nameField.error = true
            }
            if (!this.phoneField.value){
                this.phoneField.error = true
            }
        },
        async sendConsultation(){
            this.submitForm()
            if (!this.nameField.value || !this.phoneField.value){
                return;
            }
            let formData = new FormData();
            formData.append('name', this.nameField.value)
            formData.append('phone', this.phoneField.value)
            formData.append('text', this.textField.value)

            try {
                const response = await axios.post('/consultation/send', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                if (response.status === 201){
                    this.setDefaultValue()
                    this.message = 'Ваша заявка отправленна, в ближайшее время с вами свяжется наш специалист.'
                    this.isMessage = true
                }
            } catch (error) {
                this.message = error.response.data
                this.isMessage = true
            }
        },
        setDefaultValue(){
            this.nameField.value = ''
            this.nameField.error = false
            this.phoneField.value = ''
            this.phoneField.error = false
            this.textField.value = ''
            this.textField.error = false
        }
    },
}
</script>

<style scoped>
.feedback__form{
    gap: 45px;
}
.feedback__form form{
    margin-bottom: 0;
}

.popup-message{
    margin-top: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.popup-message .success{
    text-align: center;
    font-family: "Montserrat";
    font-weight: normal;
    font-size: 14px;
    line-height: 16px;
    color: #FFFFFF;
}
textarea{
    resize: none;
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
</style>
