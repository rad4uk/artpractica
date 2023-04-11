<template>
    <form method="POST">
        <div class="card-body">
            <div class="form-group">
                <label for="inputStatus">Родительская категория</label>
                <select id="inputStatus" name='parent' v-model="categoryValue" class="form-control custom-select">
                    <option value="-1">Нет</option>
                    <option-component
                        v-for="(category, idx) in this.categories"
                        :category="category"
                        :key="idx"
                        :repeat_count="0"
                    ></option-component>
                </select>
            </div>
            <div class="form-group">
                <label for="inputName">Заголовок</label>
                <input type="text" id="inputName" name="title" class="form-control" v-model="titleValue">
            </div>
            <div class="form-group">
                <label for="inputDescription">Описание</label>
                <textarea id="inputDescription" name="description" class="form-control"
                          v-model="descriptionValue"
                          rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="inputDescription">Фото проекта</label>
                <div class="custom-file">
                    <input type="file" name="preview_image" class="custom-file-input" id="validatedCustomFile"
                           @change="addPreviewFile" required>
                    <label class="custom-file-label" for="validatedCustomFile">Выберите файл...</label>
                </div>
            </div>
            <div class="form-group">
                <label for="inputUrl">Ссылка</label>
                <input type="text" id="inputUrl" name="pageUrl" v-model="urlValue" class="form-control">
            </div>
            <div class="form-group form-check-inline">
                <label class="form-check-label">
                    <input type="checkbox" name="status" v-model="statusValue" class="form-check-input">Опубликовать
                </label>
            </div>
        </div>
        <div class="row m-lg-3">
            <div class="col-12">
                <input type="submit" value="сохранить" class="btn btn-success float-left">
            </div>
        </div>
    </form>
</template>

<script>
import {adminProjectStore} from "@/store/adminlte/projectStore";
import OptionComponent from "@/Components/Adminlte/Post/OptionComponent.vue";

export default {
    name: "UpdateFormComponent",
    props: ['post', 'categories'],
    components: {
        OptionComponent
    },
    setup() {
        const projectStore = adminProjectStore()

        return {projectStore}
    },
    data: () => {
        return {
            errors: [],
            titleValue: '',
            descriptionValue: '',
            urlValue: '',
            categoryValue: -1,
            statusValue: false,
            preview_file: null
        }
    },
    mounted() {
        this.titleValue = this.post.title
        this.descriptionValue = this.post.description
        this.urlValue = this.post.slug
        this.categoryValue = this.post.category_id
        this.statusValue = this.post.status
        this.fetchFile()
    },
    methods: {
        addPreviewFile(event) {
            this.preview_file = event.target.files[0];
        },
        fetchFile() {
            fetch(this.post.preview_image)
                .then(response => response.blob())
                .then(blob => {
                    this.preview_file = new File([blob], this.post.preview_image, {type: blob.type});
                });
        }
    }
}
</script>

<style scoped>

</style>
