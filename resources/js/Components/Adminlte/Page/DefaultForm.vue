<template>
    <form method="POST" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label for="inputName">Заголовок</label>
                <input type="text" id="inputName" name="title" v-model="title" class="form-control">
            </div>
            <div class="form-group">
                <label for="inputDescription">Описание</label>
                <textarea id="inputDescription" name="description" v-model="description" class="form-control" rows="4"
                          placeholder="начните вводить текст"></textarea>
            </div>
            <div class="form-group">
                <label for="inputUrl">Ссылка (должна быть уникальной)</label>
                <input type="text" id="inputUrl" name="slug" v-model="slug" class="form-control">
            </div>
            <div class="form-group form-check-inline">
                <label class="form-check-label">
                    <input type="checkbox" name="status" v-model="status" class="form-check-input">Опубликовать
                </label>
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
    </form>

</template>

<script>
import {adminMetaDataStore} from "@/store/adminlte/metaDataStore";

export default {
    name: "DefaultForm",
    props: ['action'],
    data: () => {
        return {
            errors: [],
            title: '',
            description: '',
            slug: '',
            status: ''
        }
    },
    setup() {
        const metaDataStore = adminMetaDataStore()

        return {metaDataStore}
    },
    methods: {
        closeAlert(errorIndex) {
            this.errors.splice(errorIndex, 1);
        },
        checkForm() {
            if (this.title.length < 2) {
                this.errors.push('Заполните заголовок')
            }
            if (this.description.length < 2) {
                this.errors.push('Заполните описание')
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
            formData.append('description', this.description)
            formData.append('slug', this.slug)
            formData.append('status', this.status ? 1 : 0)
            formData.append('meta_title', this.metaDataStore.getMetaData.title)
            formData.append('meta_description', this.metaDataStore.getMetaData.description)

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
