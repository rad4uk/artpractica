<template>
    <div class="feedback">
        <div class="container">
            <div class="feedback__title">
                <h1>хотите обсудить проект</h1>
            </div>
            <div class="feedback__row">
                <div class="feedback__item feedback-form">
                    <div class="feedback__form">
                        <form action="" id="form">
                            <div class="feedback__form-item">
                                <input type="text" name="name" id="feedback__form-id" placeholder="имя">
                            </div>

                            <div class="feedback__form-item">
                                <input type="text" id="feedback__form-phone" placeholder="телефон">
                            </div>
                            <div class="feedback__form-item">
<!--                                <label for="feedback__form-text">комментарий</label>-->
                                <input type="text" id="feedback__form-text" placeholder="комментарий">
                            </div>
                            <button type="submit" class="buttonShadow">ОБРАТНЫЙ ЗВОНОК</button>
                        </form>
                        <div class="feedback__form-line">
                            <a href="https://www.vk.com/" target="_blank" class="feedback__inst">VKONTAKTE</a>
                            <a href="mailto: architect@gmail.com" class="feedback__email">architect@gmail.com</a>
                        </div>
                    </div>
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
export default {
    name: "FeedbackComponent",
}
</script>

<style scoped>

</style>
