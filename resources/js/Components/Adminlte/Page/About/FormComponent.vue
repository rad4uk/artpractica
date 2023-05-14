<template xmlns="http://www.w3.org/1999/html">
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="inputName">Заголовок</label>
                <input type="text" id="inputName" name="title" v-model="title" class="form-control">
            </div>
            <div class="form-group">
                <label for="inputUrl">Ссылка (должна быть уникальной)</label>
                <input type="text" id="inputUrl" name="slug" v-model="slug" class="form-control">
            </div>
        </form>
        <first-section-component
            :class="'card-primary card-outline'"
            :page="this.page"
            :is_type_page="this.is_type_page"
        ></first-section-component>

        <second-section-component
            :class="'card-primary card-outline'"
            :page="this.page"
            :is_type_page="this.is_type_page"
        ></second-section-component>

        <third-section-component
            :class="'card-primary card-outline'"
            :page="this.page"
            :is_type_page="this.is_type_page"
        >
        </third-section-component>

        <div class="form-group form-check-inline">
            <label class="form-check-label">
                <input type="checkbox" name="status" v-model="status" class="form-check-input">Опубликовать
            </label>
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

    </div>
</template>

<script>
import {adminMetaDataStore} from "@/store/adminlte/metaDataStore";
import {adminAboutPageStore} from "@/store/adminlte/aboutPageStore";

import FirstSectionComponent from "@/Components/Adminlte/Page/About/Partials/FirstSectionComponent.vue";
import SecondSectionComponent from "@/Components/Adminlte/Page/About/Partials/SecondSectionComponent.vue";
import ThirdSectionComponent from "@/Components/Adminlte/Page/About/Partials/ThirdSectionComponent.vue";
export default {
    name: "FormComponent",
    props: ['action', 'page', 'is_type_page'],
    components: {
        FirstSectionComponent,
        SecondSectionComponent,
        ThirdSectionComponent
    },
    data: () => {
        return {
            errors: [],
            title: '',
            slug: '',
            status: '',
        }
    },
    beforeMount() {
        if (this.is_type_page === 'edit') {
            this.title = this.page.title
            this.slug = this.page.slug
            this.status = this.page.status === 1
        }
    },
    setup() {
        const metaDataStore = adminMetaDataStore()
        const pageStore = adminAboutPageStore()

        return {metaDataStore, pageStore}
    },
    methods: {
        closeAlert(errorIndex) {
            this.errors.splice(errorIndex, 1);
        },
        checkForm() {
            if (this.title.length < 2) {
                this.errors.push('Заполните заголовок')
            }
            if (this.slug.length === 0) {
                this.errors.push('Заполните ссылку')
            }
            if (this.metaDataStore.getMetaData.title.length < 2) {
                this.errors.push('Заполните Мета Заголовок')
            }
            if (this.metaDataStore.getMetaData.description.length < 2) {
                this.errors.push('Заполните Мета Описание')
            }

            if (this.pageStore.getFirstSectionData.authorName.length < 2) {
                this.errors.push('Заполните Имя автора')
            }
            if (this.pageStore.getFirstSectionData.authorDescription.length < 2) {
                this.errors.push('Заполните поле - Текст под автором')
            }
            if (this.pageStore.getFirstSectionData.description.length < 2) {
                this.errors.push('Заполните поле - Описание')
            }
            if (!(this.pageStore.getFirstSectionData.image instanceof File)) {
                this.errors.push('Выберите файл - Изображение автора')
            }

            if (this.pageStore.getSecondSectionData.title.length < 2) {
                this.errors.push('Заполните - Заголовок ко второй секции')
            }
            if (this.pageStore.getSecondSectionData.description.length < 2) {
                this.errors.push('Заполните поле - Описание ко второй секции')
            }
            if (!(this.pageStore.getSecondSectionData.image instanceof File)) {
                this.errors.push('Выберите файл - Изображение ко второй секции')
            }

            if (this.pageStore.getThirdSectionData.title.length < 2) {
                this.errors.push('Заполните - Заголовок к третьей секции')
            }
            if (this.pageStore.getThirdSectionData.description.length < 2) {
                this.errors.push('Заполните поле - Описание к третьей секции')
            }

            if (this.errors.length > 0) {
                return false
            }

            return true
        },
        async save() {
            this.errors = [];
            if (!this.checkForm()) {
                return;
            }
            const formData = new FormData();
            formData.append('title', this.title)
            formData.append('slug', this.slug)
            formData.append('status', this.status ? 1 : 0)
            formData.append('meta_title', this.metaDataStore.getMetaData.title)
            formData.append('meta_description', this.metaDataStore.getMetaData.description)

            formData.append('first_section_data[authorName]', this.pageStore.getFirstSectionData.authorName)
            formData.append('first_section_data[authorDescription]', this.pageStore.getFirstSectionData.authorDescription)
            formData.append('first_section_data[description]', this.pageStore.getFirstSectionData.description)
            formData.append('first_section_data[image]', this.pageStore.getFirstSectionData.image)

            formData.append('second_section_data[title]', this.pageStore.getSecondSectionData.title)
            formData.append('second_section_data[description]', this.pageStore.getSecondSectionData.description)
            formData.append('second_section_data[image]', this.pageStore.getSecondSectionData.image)

            formData.append('third_section_data[title]', this.pageStore.getThirdSectionData.title)
            formData.append('third_section_data[description]', this.pageStore.getThirdSectionData.description)

            try {
                const response = await axios.post(this.action, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                if (response.status === 201) {
                    window.location.href = "/admin/pages";
                }
            } catch (error) {
                if (error.response.data.message) {
                    this.errors.push(error.response.data.message)
                } else {
                    this.errors.push(error.response.data)
                }
            }

        }
    }
}
</script>

<style scoped>

</style>
