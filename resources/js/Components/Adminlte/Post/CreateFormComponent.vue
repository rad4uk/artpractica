<template>
    <form enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label for="inputStatus">Родительская категория</label>
                <select id="inputStatus" name='parent' v-model="categoryValue" class="form-control custom-select">
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
                <label for="inputName">Подзаголовок</label>
                <input type="text" id="inputName" name="subTitle" v-model="subTitleValue" class="form-control">
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
                           @change="addPreviewFile" required>
                    <label class="custom-file-label" for="validatedCustomFile">
                        {{ this.getPreviewFileName }}
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="inputDescription">Фотографии планировки</label>
                <div class="custom-file">
                    <input type="file" name="apartment_images" multiple class="custom-file-input"
                           id="validatedCustomFile"
                           @change="addedApartmentsImages"
                           required>
                    <label class="custom-file-label" for="validatedCustomFile">
                        {{ this.getApartamentFilesName }}
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label>Дополнительные проекты</label>
                <select multiple="" class="form-control" v-model="additionalPostsValue">
                    <option v-for="(post, idx) in this.all_additional_posts"
                            :key="idx"
                            :value="post.id"
                    >{{ post.title }}
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label for="inputName">Площадь</label>
                <input type="number" name="title" v-model="squareValue" class="form-control">
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
                <input type="submit" value="Сохранить" class="btn btn-success float-left" @click.prevent="this.save()">
            </div>
        </div>
    </form>
    <div v-if="errors.length" class="row m-lg-3">
        <ul class="error-list">
            <li v-for="(error, index) in errors"
                class="error-list__item alert alert-warning"
            >{{ error }}<span
                @click="closeAlert(index)">x</span></li>
        </ul>
    </div>
    <spinner :class="{'active': this.spinnerActive}"></spinner>
</template>

<script>
import {adminProjectStore} from "@/store/adminlte/projectStore";
import Spinner from "@/Components/Adminlte/Spinner.vue";

import OptionComponent from "./OptionComponent.vue";

export default {
    name: "CreateFormComponent",
    props: [
        'action',
        'categories',
        'type_admin_page',
        'post',
        'file_dir',
        'additional_posts',
        'all_additional_posts',
    ],
    components: {
        OptionComponent,
        Spinner
    },
    setup() {
        const projectStore = adminProjectStore()
        return {projectStore}
    },
    mounted() {
        if (this.type_admin_page === 'edit') {
            this.additional_posts.forEach(item => {
                this.additionalPostsValue.push(item.id)
            })
        }
    },
    data: () => {
        return {
            spinnerActive: false,
            errors: [],
            additionalPostsValue: [],
            titleValue: '',
            subTitleValue: '',
            descriptionValue: '',
            squareValue: null,
            urlValue: '',
            categoryValue: -1,
            statusValue: false,
            preview_file: null,
            apartment_images: []
        }
    },
    async beforeMount() {
        if (this.type_admin_page === 'edit') {
            this.titleValue = this.post.title
            this.subTitleValue = this.post.sub_title
            this.descriptionValue = this.post.description !== null ? this.post.description : ''
            this.squareValue = this.post.square
            this.urlValue = this.post.slug
            this.categoryValue = this.post.category_id
            this.statusValue = this.post.status === 1
            this.preview_file = await this.fetchFile(this.file_dir, this.post.preview_image.default)
            const apartment_images = JSON.parse(this.post.apartment_images)
            if (apartment_images.length > 0) {
                await this.setApartmentImages(apartment_images)
            }
            // this.additional_posts.forEach((item) => {
            //     this.additionalPostsValue.push(item.id)
            // })
        }
    },
    methods: {
        async setApartmentImages(images) {
            await Promise.all(
                images.map(async (fileName) => {
                    let file = await this.fetchFile(this.file_dir, fileName)
                    this.apartment_images.push(file)
                })
            )
        },
        addedApartmentsImages(event) {
            this.apartment_images = [];
            const files = event.target.files;
            for (let i = 0; i < files.length; i++) {
                this.apartment_images.push(files[i])
            }
        },
        async fetchFile(fileDir, fileName) {
            return await fetch(fileDir + '/' + fileName)
                .then(response => response.blob())
                .then(blob => {
                    return new File([blob], fileName, {type: blob.type});
                });
        },
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
            if (this.subTitleValue.length === 0) {
                this.errors.push('Укажите Подзаголовок');
            }
            if (this.urlValue.length === 0) {
                this.errors.push('Укажите Ссылку.');
            }
            if (this.file === null) {
                this.errors.push('Вы забыли добавить фото проекта.');
            }
            if (this.apartment_images.length === 0) {
                this.errors.push('Вы забыли добавить фотографии планировки');
            }

            if (this.squareValue === null || this.squareValue.length === 0) {
                this.errors.push('Вы забыли указать площадь');
            }

            if (this.additionalPostsValue.length === 1) {
                this.errors.push('Количество дополнительных проектов должно быть больше одного');
            }

            if (this.projectStore.getMetaData.title.length < 2) {
                this.errors.push('Заполните Мета Заголовок')
            }
            if (this.projectStore.getMetaData.description.length < 2) {
                this.errors.push('Заполните Мета Описание')
            }

            if (!this.errors.length) {
                return true;
            }

            return false;
        },
        addPreviewFile(event) {
            this.preview_file = event.target.files[0];
        },
        async save() {
            if (this.checkForm()) {
                this.spinnerActive = true
                const widgetsFormName = 'widgets'
                let formData = new FormData()
                formData.append('formData[category_id]', this.categoryValue)
                formData.append('formData[title]', this.titleValue)
                formData.append('formData[sub_title]', this.subTitleValue)
                formData.append('formData[description]', this.descriptionValue)
                formData.append('formData[square]', this.squareValue)
                formData.append('formData[slug]', this.urlValue)
                formData.append('formData[preview_file]', this.preview_file)
                formData.append('formData[status]', this.statusValue ? 1 : 0)
                formData.append('formData[meta_title]', this.projectStore.getMetaData.title)
                formData.append('formData[meta_description]', this.projectStore.getMetaData.description)

                if (this.apartment_images.length > 0) {
                    this.apartment_images.forEach((file) => {
                        formData.append('formData[apartment_images][]', file)
                    })
                }

                if (this.additionalPostsValue.length > 0) {
                    this.additionalPostsValue.forEach((postId) => {
                        formData.append('formData[additionalPosts][]', postId)
                    })
                }

                const emptyWidgets = this.projectStore.getEmptyWidgets;

                for (let i = 0; i < emptyWidgets.length; i++) {

                    const widgetId = emptyWidgets[i].id;
                    const widgetName = emptyWidgets[i].name;
                    const widgetTitle = emptyWidgets[i].widgetTitle;
                    const widgetData = emptyWidgets[i].data;
                    formData.append(`${widgetsFormName}[${i}][id]`, widgetId);
                    formData.append(`${widgetsFormName}[${i}][name]`, widgetName);
                    formData.append(`${widgetsFormName}[${i}][widgetTitle]`, widgetTitle);

                    const keys = Object.keys(widgetData);
                    for (const key of keys) {
                        const value = widgetData[key];

                        if (Array.isArray(value)) {
                            for (const file of value) {
                                formData.append(`${widgetsFormName}[${i}][data][${key}][]`, file);
                            }
                        } else {
                            formData.append(`${widgetsFormName}[${i}][data][${key}]`, value);
                        }
                    }

                }

                try {
                    const response = await axios.post(this.action, formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    if (response.status === 201) {
                        window.location.href = "/admin/post";
                    }
                } catch (error) {
                    if (error.response.data.message) {
                        this.errors.push(error.response.data.message)
                    } else {
                        this.errors.push(error.response.data)
                    }
                } finally {
                    this.spinnerActive = false
                }
            }
        },
    },
    computed: {
        getPreviewFileName: function () {
            return this.preview_file instanceof File ? this.preview_file.name.slice(-15) : 'Выберите файл...'
        },
        getApartamentFilesName: function () {
            let fileName = '';
            this.apartment_images.forEach(function (file) {
                if (file instanceof File) {
                    fileName += file.name.slice(-15) + ', '
                }
            })
            return fileName.length > 0 ? fileName.replace(/, $/mg, '') : 'Выберите файлы...'
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
