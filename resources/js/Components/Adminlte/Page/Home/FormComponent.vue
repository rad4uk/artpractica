<template>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label for="inputName">Заголовок</label>
                <input type="text" id="inputName" name="title" class="form-control" value="">
            </div>
            <div class="form-group">
                <label for="inputDescription">Описание</label>
                <textarea id="inputDescription" name="description" class="form-control" rows="4" placeholder="начните вводить текст"></textarea>
            </div>
            <div class="form-group">
                <label for="inputUrl">Ссылка (должна быть уникальной)</label>
                <input type="text" id="inputUrl" name="slug" class="form-control" value="">
            </div>
            <div class="form-group form-check-inline">
                <label class="form-check-label">
                    <input type="checkbox" name="status" class="form-check-input">Опубликовать
                </label>
            </div>
        </div>

        <first-form-partial></first-form-partial>
        <second-form-partial></second-form-partial>

        <files-for-slider-partial></files-for-slider-partial>
        <files-for-slider-partial></files-for-slider-partial>
        <files-for-slider-partial></files-for-slider-partial>
    </form>
</template>

<script>
import FirstFormPartial from "./Partials/FirstFormPartial.vue";
import SecondFormPartial from "./Partials/SecondFormPartial.vue";
import FilesForSliderPartial from "./Partials/FilesForSliderPartial.vue";
export default {
    name: "FormComponent",
    components: {
        FirstFormPartial,
        SecondFormPartial,
        FilesForSliderPartial
    },

}
</script>

<style lang="scss" scoped>

</style>
