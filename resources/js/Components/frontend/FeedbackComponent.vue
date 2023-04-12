<template>
    <div class="feedback">
        <div class="container">
            <div class="feedback__title">
                <h1>хотите обсудить проект</h1>
            </div>
            <div class="feedback__row">
                <div class="feedback__item feedback-form">
                    <ConsultationForm></ConsultationForm>
                </div>
                <div class="feedback__item feedback-image">
                    <div class="feedback__image">
                        <img
                            lazy
                            v-lazy="{
                              src: '/images/project_form.png',
                              error: 'url',
                            }"
                            alt="Проект">
                    </div>
                </div>

            </div>

        </div>
    </div>

</template>

<script>
import ConsultationForm from "./ConsultationForm.vue";
export default {
    name: "FeedbackComponent",
    components: {
        ConsultationForm
    },

}
</script>

<style scoped>

</style>
