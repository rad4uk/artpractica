<template>
    <form enctype="multipart/form-data">
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
                <input type="text" id="inputName" name="title" v-model="titleValue" class="form-control">
            </div>
            <div class="form-group">
                <label for="inputDescription">Описание</label>
                <textarea id="inputDescription" name="description" class="form-control" rows="4"
                          v-model="descriptionValue" placeholder="начните вводить текст"></textarea>
            </div>
            <div class="form-group">
                <label for="inputDescription">Фото проекта</label>
                <div class="custom-file">
                    <input type="file" name="preview_image" class="custom-file-input" id="validatedCustomFile"
                           @change="addFile" required>
                    <label class="custom-file-label" for="validatedCustomFile">Выберите файл...</label>
                </div>
            </div>
            <div class="form-group">
                <label for="inputUrl">Ссылка (должна быть уникальной)</label>
                <input type="text" id="inputUrl" name="slug" v-model="urlValue" class="form-control">
            </div>
            <div class="form-group form-check-inline">
                <label class="form-check-label">
                    <input type="checkbox" name="status" v-model="statusValue" class="form-check-input">Опубликовать
                </label>
            </div>
        </div>
        <div class="row m-lg-3">
            <div class="col-12">
                <input type="submit" value="Добавить" class="btn btn-success float-left" @click.prevent="this.save()">
            </div>
        </div>
    </form>
    <div v-if="errors.length" class="row m-lg-3">
        <ul class="error-list">
            <li v-for="(error, index) in errors" class="error-list__item alert alert-warning">{{ error }}<span
                @click="closeAlert(index)">x</span></li>
        </ul>
    </div>
</template>

<script>
import {adminProjectStore} from "@/store/adminlte/projectStore";
import OptionComponent from "./OptionComponent.vue";

export default {
    name: "CreateFormComponent",
    props: ['action', 'categories'],
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
            file: null
        }
    },
    methods: {
        closeAlert(errorIndex) {
            this.errors.splice(errorIndex, 1);
        },
        checkForm() {
            this.errors = [];

            if (this.categoryValue === -1) {
                this.errors.push('Выберите категорию.');
            }
            if (this.titleValue.length === 0) {
                this.errors.push('Укажите Заголовок');
            }
            if (this.descriptionValue.length === 0) {
                this.errors.push('Укажите Описание.');
            }
            if (this.urlValue.length === 0) {
                this.errors.push('Укажите Ссылку.');
            }
            if (this.file === null) {
                this.errors.push('Вы забыли добавить фото проекта.');
            }

            if (!this.errors.length) {
                return true;
            }

            return false;
        },
        addFile(event) {
            this.file = event.target.files[0];
        },
        async save() {

            if (this.checkForm()) {

                const widgetsFormName = 'widgets'
                let formData = new FormData()
                formData.append('formData[categoryId]', this.categoryValue)
                formData.append('formData[title]', this.titleValue)
                formData.append('formData[description]', this.descriptionValue)
                formData.append('formData[slug]', this.urlValue)
                formData.append('formData[file]', this.file)
                formData.append('formData[status]', this.statusValue ? 1 : 0)
                const emptyWidgets = this.projectStore.getEmptyWidgets;
                for (let i = 0; i < emptyWidgets.length; i++) {

                    const widgetName = emptyWidgets[i].name;
                    const widgetData = emptyWidgets[i].data;

                    const keys = Object.keys(widgetData);
                    for (const key of keys) {
                        const value = widgetData[key];

                        if (Array.isArray(value)) {
                            for (const file of value) {
                                formData.append(`${widgetsFormName}[${i}][${widgetName}][${key}][]`, file);
                            }
                        } else {
                            formData.append(`${widgetsFormName}[${i}][${widgetName}][${key}]`, value);
                        }
                    }

                }

                try {
                    const response = await axios.post('/api/project/new', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    if (response.status === 201){
                        window.location.href = "/admin/post";
                    }
                } catch (error) {
                    this.errors.push(error)
                }
            }
        },
    }
}
</script>

<style lang="scss" scoped>
.error-list {
    padding: 0;
    display: flex;
    flex: 0 1 100%;
    flex-direction: column;

    &__item {
        list-style: none;
        display: flex;
        flex: 0 1 100%;
        justify-content: space-between;
        align-items: center;
        padding: 5px 10px;

        span {
            cursor: pointer;
            padding: 5px;
        }
    }
}
</style>
