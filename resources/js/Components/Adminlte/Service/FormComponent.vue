<template>
    <form action="#" method="POST" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label for="inputStatus">Родительская категория</label>
                <select id="inputStatus" name='parent' class="form-control custom-select">
                    <option value="-1">Нет</option>
                </select>
            </div>
            <div class="form-group">
                <label for="inputName">Заголовок</label>
                <input type="text" id="inputName" name="title" class="form-control" value="">
            </div>
            <div class="form-group">
                <label for="inputDescription">Описание</label>
                <ckeditor :editor="editor" v-model="editorData" :config="editorConfig"></ckeditor>
            </div>
            <div class="form-group">
                <label for="inputDescription">Фото проекта</label>
                <div class="custom-file">
                    <input type="file" name="preview_image" class="custom-file-input" id="validatedCustomFile" required>
                    <label class="custom-file-label" for="validatedCustomFile">Выберите файл...</label>
                    <div class="invalid-feedback">Example invalid custom file feedback</div>
                </div>
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
    </form>


    <main-template-component></main-template-component>
    <div class="row m-lg-3">
        <div class="col-12">
            <input type="submit" value="Сохранить" class="btn btn-success float-left">
        </div>
    </div>
</template>

<script>
import MainTemplateComponent from "./MainTemplateComponent.vue";
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
export default {
    name: "FormComponent",
    components: {
        MainTemplateComponent
    },
    data() {
        return {
            editor: ClassicEditor,
            editorData: '',
            editorConfig: {
                // The configuration of the editor.
            }
        };
    }
}
</script>

<style scoped>

</style>
