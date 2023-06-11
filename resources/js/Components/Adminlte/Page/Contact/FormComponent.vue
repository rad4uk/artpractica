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

        <contact-fields
            :data="this.page.first_section_data"
            @setAddress="handleAddress"
            @setPhone="handlePhone"
            @setEmail="handleEmail"
        ></contact-fields>

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

import ContactFields from "@/Components/Adminlte/Page/Contact/Partials/ContactFields.vue";

export default {
    name: "FormComponent",
    props: ['action', 'page', 'is_type_page'],

    components: {
        ContactFields
    },
    data: () => {
        return {
            errors: [],
            title: '',
            slug: '',
            status: '',
            address: '',
            phone: '',
            email: ''
        }
    },
    beforeMount() {
        console.log(this.page)
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

            if (this.address.length < 1){
                this.errors.push('Укажите адрес')
            }
            if (this.phone.length < 1){
                this.errors.push('Укажите телефон')
            }
            if (this.email.length < 1){
                this.errors.push('Укажите email')
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

            formData.append('fields[address]', this.address)
            formData.append('fields[phone]', this.phone)
            formData.append('fields[email]', this.email)


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

        },

        handleAddress(value){
            this.address = value
        },
        handlePhone(value){
            this.phone = value
        },
        handleEmail(value){
            this.email = value
        },
    }
}
</script>

<style scoped>

</style>
