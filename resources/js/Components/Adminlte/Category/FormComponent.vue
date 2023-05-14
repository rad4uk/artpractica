<template>
    <form method="POST" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label for="inputName">Название</label>
                <input type="text" id="inputName" name="title" class="form-control" v-model="title">
            </div>
            <div class="form-group">
                <label for="inputDescription">Описание</label>
                <textarea id="inputDescription" name="description" class="form-control" rows="4"
                          v-model="description"></textarea>
            </div>
            <div class="form-group">
                <label for="inputUrl">Ссылка</label>
                <input type="text" id="inputUrl" name="slug" class="form-control" v-model="slug">
            </div>
            <div class="form-group">
                <label for="inputStatus">Родительская категория</label>
                <select id="inputStatus" name='parent_id' class="form-control custom-select" v-model="categoryId">
                    <option value="-1">Нет</option>
                    <option-component
                        v-for="(category, idx) in this.categories"
                        :category="category"
                        :key="idx"
                        :repeat_count="0"
                    ></option-component>
                </select>
            </div>
            <div class="form-group form-check-inline">
                <label class="form-check-label">
                    <input type="checkbox" name="status" class="form-check-input" v-model="status">Опубликовать
                </label>
            </div>

            <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel"
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
                                            <input type="file" name="page_image" class="custom-file-input"
                                                   id="validatedCustomFile">
                                            <label class="custom-file-label" for="validatedCustomFile">Выберите
                                                файл</label>
                                        </div>
                                    </div>
                                    <div class="form-group" style="width: 100%">
                                        <label for="inputStatus">Выберите страницу</label>
                                        <select id="inputStatus" name='page_id' class="form-control custom-select"
                                                v-model="pageId">
                                            <option value="-1">Нет</option>
                                            <option
                                                v-for="(item, idx) in this.pages"
                                                :key="idx"
                                                :value="item.id"
                                            >{{ item.title }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group" style="width: 100%">
                                        <label for="inputName">Порядок сортировки</label>
                                        <input type="number" id="inputName" name="page_sort" class="form-control"
                                               v-model="sort">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="row m-lg-3">
            <div class="col-12">
                <input type="submit" value="сохранить" class="btn btn-success float-left"
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
    </form>

</template>

<script>
import OptionComponent from "../Post/OptionComponent.vue";
import {adminCategoryStore} from "@/store/adminlte/categoryStore";

export default {
    name: "FormComponent",
    components: {
        OptionComponent
    },
    setup() {
        const categoryStore = adminCategoryStore()

        return {categoryStore}
    },
    data: () => {
        return {
            errors: [],
            title: '',
            description: '',
            slug: '',
            status: false,
            categoryId: -1,
            pageId: -1,
            sort: '',
            page_image: ''
        }
    },
    props: [
        'action',
        'category',
        'categories',
        'pages',
        'is_type_page'
    ],
    async beforeMount() {
        console.log(this.category)
        if (this.is_type_page === 'edit') {
            this.title = this.category.title
            this.description = this.category.description
            this.slug = this.category.slug
            this.status = this.category.status === 1
            this.sort = this.category.page_sort
            this.categoryId = this.category.parent_id
            this.pageId = this.category.page_id

            if (this.category.page_sort !== null) {
                this.sort = this.category.page_sort
            }
            if (this.category.page_id !== null) {
                this.pageId = this.category.page_id
            }

            if (this.category.page_image !== null) {
                this.page_image = await this.fetchFile(this.category.dirImagePath, this.category.page_image)
            }
        }
    },
    methods: {
        closeAlert(errorIndex) {
            this.errors.splice(errorIndex, 1);
        },
        checkForm() {
            console.log(this.status)
            this.errors = [];

            if (this.title.length === 0) {
                this.errors.push('Укажите Заголовок');
            }
            if (this.description.length === 0) {
                this.errors.push('Укажите Описание.');
            }
            if (this.slug.length === 0) {
                this.errors.push('Укажите Ссылку.');
            }

            if (this.categoryStore.getMetaData.title.length < 2) {
                this.errors.push('Заполните Мета Заголовок')
            }
            if (this.categoryStore.getMetaData.description.length < 2) {
                this.errors.push('Заполните Мета Описание')
            }

            if(this.pageId !== -1 && this.pageId !== null){
                if (!(this.page_image instanceof File)){
                    this.errors.push('Вы выбрали отображение данной категории на главной странице, но забыли загрузить изображение')
                }
            }

            if (!this.errors.length) {
                return true;
            }

            return false;
        },
        async save() {
            if (!this.checkForm()) {
                return;
            }

            let formData = new FormData()
            formData.append('parent_id', this.categoryId)
            formData.append('title', this.title)
            formData.append('description', this.description)
            formData.append('slug', this.slug)
            formData.append('status', this.status ? 1 : 0)
            if (this.page_image instanceof File && this.pageId !== '-1'){
                formData.append('page_image', this.page_image)
                formData.append('page_id', this.pageId)
                formData.append('page_sort', this.sort)
            }
            formData.append('meta_title', this.categoryStore.getMetaData.title)
            formData.append('meta_description', this.categoryStore.getMetaData.description)

            try {
                const response = await axios.post(this.action, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                if (response.status === 201) {
                    window.location.href = response.data.route;
                }
            } catch (error) {
                if (error.response.data.message) {
                    this.errors.push(error.response.data.message)
                } else {
                    this.errors.push(error.response.data)
                }
            }
        },
        async fetchFile(dirPath, fileName) {
            return await fetch(`${dirPath}/${fileName}`)
                .then(response => response.blob())
                .then(blob => new File([blob], fileName, {type: blob.type}));
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
