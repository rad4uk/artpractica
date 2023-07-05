<template>
    <form action="#" method="POST" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label for="inputStatus">Родительская категория</label>
                <select id="inputStatus" name='parent' class="form-control custom-select" v-model="category_id">
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
                <input type="text" id="inputName" name="title" class="form-control" v-model="title">
            </div>
            <div class="form-group">
                <label for="inputName">Заголовок для меню</label>
                <input type="text" id="inputName" name="tab_title" class="form-control" v-model="tab_title">
            </div>
            <div class="form-group">
                <label for="inputDescription">Описание</label>
                <ckeditor :editor="editor" v-model="description" :config="editorConfig"></ckeditor>
            </div>
            <div class="form-group">
                <label for="inputDescription">Фото услуги</label>
                <div class="custom-file">
                    <input type="file" name="preview_image" class="custom-file-input"
                           @change="this.addedPreviewImage"
                           id="validatedCustomFile" required>
                    <label class="custom-file-label" for="validatedCustomFile">
                        {{ this.getPreviewImageName }}
                    </label>
                    <div class="invalid-feedback">Example invalid custom file feedback</div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputUrl">Ссылка (должна быть уникальной)</label>
                <input type="text" id="inputUrl" name="slug" v-model="slug" class="form-control">
            </div>
            <div class="form-group form-check-inline">
                <label class="form-check-label">
                    <input type="checkbox" name="status" class="form-check-input" v-model="status">Опубликовать
                </label>
            </div>
        </div>
    </form>


    <main-template-component
        :template_data="this.template_data"
        :file_dir="this.file_dir"
        :service="this.service"
    ></main-template-component>

    <div class="tab-pane fade active show card-body" id="custom-tabs-three-home" role="tabpanel"
         aria-labelledby="custom-tabs-three-home-tab">

        <div class="card card-blue card-outline collapsed-card">
            <div class="card-header">
                <h3 class="card-title">Отображение на главной</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body" style="display: none;">
                <div class="form-group collection-wrapper">
                    <div class="secondSectionDescription" id="secondSectionDescription">
                        <div class="row collection-row">
                            <div class="form-group" style="width: 100%">
                                <label for="inputDescription">Изображение</label>
                                <div class="custom-file">
                                    <input type="file" name="page_image" class="custom-file-input" id="validatedCustomFile"
                                           @change="this.addedPageImage"
                                    >
                                    <label class="custom-file-label" for="validatedCustomFile">
                                        {{ this.getHomePageImageName }}
                                    </label>
                                </div>
                            </div>
                            <div class="form-group" style="width: 100%">
                                <label for="inputDescription">Описание</label>
                                <ckeditor :editor="editor" v-model="pageDescription" :config="editorConfig"></ckeditor>
                            </div>
                            <div class="form-group" style="width: 100%">
                                <label for="inputStatus">Выберите страницу</label>
                                <select id="inputStatus" name='page_id' v-model="pageId" class="form-control custom-select">
                                    <option value="-1">Нет</option>
                                    <option
                                        v-for="page in this.pages"
                                        :value="page.id"
                                    >{{page.title}}</option>
                                </select>
                            </div>
                            <div class="form-group" style="width: 100%">
                                <label for="inputName">Порядок сортировки</label>
                                <input type="number" id="inputName" name="page_sort" v-model="pageSort" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>




    <div class="row m-lg-3">
        <div class="col-12">
            <input type="submit" value="Сохранить" class="btn btn-success float-left"
                @click.prevent="this.save()"
            >
        </div>
    </div>
    <div v-if="errors.length" class="row m-lg-3">
        <ul class="error-list">
            <li v-for="(error, index) in errors"
                class="error-list__item alert alert-warning"
            >{{ error }}<span
                @click="closeAlert(index)">x</span></li>
        </ul>
    </div>
</template>

<script>
import MainTemplateComponent from "./MainTemplateComponent.vue";
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import {adminServicesStore} from "@/store/adminlte/servicesStore";
import OptionComponent from "../Post/OptionComponent.vue";
export default {
    name: "FormComponent",
    components: {
        MainTemplateComponent,
        OptionComponent
    },
    props: [
        'action',
        'categories',
        'is_type_page',
        'template_data',
        'service',
        'file_dir',
        'pages'
    ],
    setup() {
        const servicesStore = adminServicesStore()

        return {servicesStore}
    },
    async mounted() {
        if (this.is_type_page === 'edit'){
            this.servicesStore.setEditPageTemplate(this.template_data)
            this.category_id = this.service.category_id
            this.title = this.service.title
            this.description = this.service.description
            this.slug = this.service.slug
            this.preview_image = await this.fetchFile(this.file_dir, this.service.preview_image)
            this.status = this.service.status
            this.tab_title = this.service.tab_title

            if (this.service.page_description !== null) {
                this.pageDescription = this.service.page_description
            }
            if (this.service.page_sort !== null) {
                this.pageSort = this.service.page_sort
            }
            if (this.service.page_id !== null) {
                this.pageId = this.service.page_id
            }
            if (this.service.page_image !== null){
                this.page_image = await this.fetchFile(this.file_dir, this.service.page_image)
            }

        }
    },
    data() {
        return {
            tab_title: '',
            pageDescription: '',
            pageId: -1,
            page_image: '',
            pageSort: '',
            status: false,
            category_id: null,
            title: '',
            description: '',
            slug: '',
            preview_image: null,
            errors: [],
            editor: ClassicEditor,
            editorConfig: {
                // The configuration of the editor.
            }
        };
    },
    methods: {
        async fetchFile(dirPath, fileName) {
            return await fetch(`${dirPath}/${fileName}`)
                .then(response => response.blob())
                .then(blob => new File([blob], fileName, { type: blob.type }));
        },
        closeAlert(errorIndex) {
            this.errors.splice(errorIndex, 1);
        },
        checkForm() {
            this.errors = [];

            if (this.category_id === null) {
                this.errors.push('Выберите категорию.');
            }
            if (this.title.length === 0) {
                this.errors.push('Укажите Заголовок');
            }
            if (this.description.length === 0) {
                this.errors.push('Укажите Описание.');
            }
            if (this.slug.length === 0) {
                this.errors.push('Укажите Ссылку.');
            }
            if (this.preview_image === null) {
                this.errors.push('Вы забыли добавить фото услуги.');
            }

            if (this.servicesStore.getMetaData.title.length < 2) {
                this.errors.push('Заполните Мета Заголовок')
            }
            if (this.servicesStore.getMetaData.description.length < 2) {
                this.errors.push('Заполните Мета Описание')
            }


            if (!this.errors.length) {
                return true;
            }

            return false;
        },
        async save(){
            if (!this.checkForm()){
                return;
            }
            const templateData = this.servicesStore.getCurrentTemplate
            if (templateData === null){
                this.errors.push('Выберите и заполните шаблон')
                return;
            }
            let formData = new FormData()
            formData.append('formData[category_id]', this.category_id)
            formData.append('formData[title]', this.title)
            formData.append('formData[tab_title]', this.tab_title)
            formData.append('formData[description]', this.description)
            formData.append('formData[slug]', this.slug)
            formData.append('formData[preview_image]', this.preview_image)
            formData.append('formData[status]', this.status ? 1 : 0)
            formData.append('formData[page_image]', this.page_image)
            formData.append('formData[page_description]', this.pageDescription)
            formData.append('formData[page_id]', this.pageId)
            formData.append('formData[page_sort]', this.pageSort)
            formData.append('formData[meta_title]', this.servicesStore.getMetaData.title)
            formData.append('formData[meta_description]', this.servicesStore.getMetaData.description)

            const templateFormData = this.getTemplateFormData(templateData, formData)

            try {
                const response = await axios.post(this.action, templateFormData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                if (response.status === 201){
                    window.location.href = "/admin/services";
                }
            } catch (error) {
                if (error.response.data.message){
                    this.errors.push(error.response.data.message)
                }else{
                    this.errors.push(error.response.data)
                }
            }
        },
        getTemplateFormData(templateData, formData){
            if(templateData.name === 'firstTemplate'){
                formData.append('templateData[name]', templateData.name)
                formData.append('templateData[first_section_title]', templateData.first_section_title)
                formData.append('templateData[first_section_description]', JSON.stringify(templateData.first_section_description))
            }
            if(templateData.name === 'secondTemplate'){
                formData.append('templateData[name]', templateData.name)
                formData.append('templateData[first_section_description]', JSON.stringify(templateData.first_section_description))
                formData.append('templateData[second_section_title]', templateData.second_section_title)
                formData.append('templateData[second_section_image]', templateData.second_section_image)
                formData.append('templateData[second_section_description]', templateData.second_section_description)
                formData.append('templateData[third_section_title]', templateData.third_section_title)
                formData.append('templateData[third_section_description]', templateData.third_section_description)
            }

            if(templateData.name === 'thirdTemplate'){
                formData.append('templateData[name]', templateData.name)
                formData.append('templateData[second_section_title]', templateData.second_section_title)
                formData.append('templateData[second_section_description]', templateData.second_section_description)
                formData.append('templateData[second_section_image]', templateData.second_section_image)
                formData.append('templateData[first_section_description]', JSON.stringify(templateData.first_section_description))
                formData.append('templateData[third_section_title]', templateData.third_section_title)
                formData.append('templateData[third_section_description]', templateData.third_section_description)
                templateData.third_section_images.forEach( (file) => {
                    formData.append('templateData[third_section_images][]', file)
                })
            }
            return formData
        },
        addedPreviewImage(event){
            this.preview_image = event.target.files[0];
        },
        addedPageImage(event){
            this.page_image = event.target.files[0];
        }
    },
    computed: {
        getPreviewImageName: function (){
            return this.preview_image instanceof File ? this.preview_image.name.slice(-10) : 'Выберите файл'
        },
        getHomePageImageName: function (){
            return this.page_image instanceof File ? this.page_image.name.slice(-10) : 'Выберите файл'
        }
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
