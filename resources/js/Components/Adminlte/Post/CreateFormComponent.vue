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
                           @change="addPreviewFile" required>
                    <label class="custom-file-label" for="validatedCustomFile">Выберите файл...</label>
                </div>
            </div>
            <div class="form-group">
                <label for="inputDescription">Фотографии планировки</label>
                <div class="custom-file">
                    <input type="file" name="apartment_images" multiple class="custom-file-input" id="validatedCustomFile"
                           @change="addedApartmentsImages"
                           required>
                    <label class="custom-file-label" for="validatedCustomFile">Выберите файлы...</label>
                </div>
            </div>
            <div class="form-group">
                <label>Дополнительные проекты</label>
                <select multiple="" class="form-control" v-model="additionalPostsValue">
                    <option v-for="(post, idx) in this.all_additional_posts"
                            :key="idx"
                            :value="post.id"
                    >{{post.title}}</option>
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
    <div class="spinner" :class="{'active': this.spinnerActive}">
        <div class="center">
            <div class="spinner-blade"></div>
            <div class="spinner-blade"></div>
            <div class="spinner-blade"></div>
            <div class="spinner-blade"></div>
            <div class="spinner-blade"></div>
            <div class="spinner-blade"></div>
            <div class="spinner-blade"></div>
            <div class="spinner-blade"></div>
            <div class="spinner-blade"></div>
            <div class="spinner-blade"></div>
            <div class="spinner-blade"></div>
            <div class="spinner-blade"></div>
        </div>

    </div>
</template>

<script>
import {adminProjectStore} from "@/store/adminlte/projectStore";
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
        OptionComponent
    },
    setup() {
        const projectStore = adminProjectStore()
        return {projectStore}
    },
    mounted() {
        if (this.type_admin_page === 'edit'){
            this.additional_posts.forEach( item => {
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
            this.descriptionValue = this.post.description
            this.squareValue = this.post.square
            this.urlValue = this.post.slug
            this.categoryValue = this.post.category_id
            this.statusValue = this.post.status === 1
            this.preview_file = await this.fetchFile(this.file_dir, this.post.preview_image)
            const apartment_images = JSON.parse(this.post.apartment_images)
            if (apartment_images.length > 0){
                await this.setApartmentImages(apartment_images)
            }
            // this.additional_posts.forEach((item) => {
            //     this.additionalPostsValue.push(item.id)
            // })
        }
    },
    methods: {
        async setApartmentImages(images){
            await Promise.all(
                images.map( async (fileName) => {
                    let file = await this.fetchFile(this.file_dir, fileName)
                    this.apartment_images.push(file)
                })
            )
        },
        addedApartmentsImages(event){
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
            if (this.descriptionValue.length === 0) {
                this.errors.push('Укажите Описание.');
            }
            if (this.urlValue.length === 0) {
                this.errors.push('Укажите Ссылку.');
            }
            if (this.file === null) {
                this.errors.push('Вы забыли добавить фото проекта.');
            }
            if (this.apartment_images.length === 0){
                this.errors.push('Вы забыли добавить фотографии планировки');
            }

            if (this.squareValue === null || this.squareValue.length === 0){
                this.errors.push('Вы забыли указать площадь');
            }

            if (this.additionalPostsValue.length === 1){
                this.errors.push('Количество дополнительных проектов должно быть больше одного');
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
                formData.append('formData[description]', this.descriptionValue)
                formData.append('formData[square]', this.squareValue)
                formData.append('formData[slug]', this.urlValue)
                formData.append('formData[preview_file]', this.preview_file)
                formData.append('formData[status]', this.statusValue ? 1 : 0)

                if (this.apartment_images.length > 0){
                    this.apartment_images.forEach( (file) => {
                        formData.append('formData[apartment_images][]', file)
                    })
                }

                if (this.additionalPostsValue.length > 0) {
                    this.additionalPostsValue.forEach( (postId) => {
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
                    if (response.status === 201){
                        window.location.href = "/admin/post";
                    }
                } catch (error) {
                    if (error.response.data.message){
                        this.errors.push(error.response.data.message)
                    }else{
                        this.errors.push(error.response.data)
                    }
                }finally {
                    this.spinnerActive = false
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


.spinner.active{
    display: flex;
}
.spinner {
    font-size: 28px;
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: #fff;
    opacity: 0.6;
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 10000;
}

.spinner .center {
    position: relative;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    margin: auto;
}

.spinner .spinner-blade {
    position: absolute;
    left: 0.4629em;
    width: 0.1em;
    height: 0.8331em;
    border-radius: 0.0555em;
    background-color: transparent;
    -webkit-transform-origin: center -0.2222em;
    -ms-transform-origin: center -0.2222em;
    transform-origin: center -0.2222em;
    animation: spinner-fade9234 1s infinite linear;
}

.spinner .spinner-blade:nth-child(1) {
    -webkit-animation-delay: 0s;
    animation-delay: 0s;
    -webkit-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    transform: rotate(0deg);
}

.spinner .spinner-blade:nth-child(2) {
    -webkit-animation-delay: 0.083s;
    animation-delay: 0.083s;
    -webkit-transform: rotate(30deg);
    -ms-transform: rotate(30deg);
    transform: rotate(30deg);
}

.spinner .spinner-blade:nth-child(3) {
    -webkit-animation-delay: 0.166s;
    animation-delay: 0.166s;
    -webkit-transform: rotate(60deg);
    -ms-transform: rotate(60deg);
    transform: rotate(60deg);
}

.spinner .spinner-blade:nth-child(4) {
    -webkit-animation-delay: 0.249s;
    animation-delay: 0.249s;
    -webkit-transform: rotate(90deg);
    -ms-transform: rotate(90deg);
    transform: rotate(90deg);
}

.spinner .spinner-blade:nth-child(5) {
    -webkit-animation-delay: 0.332s;
    animation-delay: 0.332s;
    -webkit-transform: rotate(120deg);
    -ms-transform: rotate(120deg);
    transform: rotate(120deg);
}

.spinner .spinner-blade:nth-child(6) {
    -webkit-animation-delay: 0.415s;
    animation-delay: 0.415s;
    -webkit-transform: rotate(150deg);
    -ms-transform: rotate(150deg);
    transform: rotate(150deg);
}

.spinner .spinner-blade:nth-child(7) {
    -webkit-animation-delay: 0.498s;
    animation-delay: 0.498s;
    -webkit-transform: rotate(180deg);
    -ms-transform: rotate(180deg);
    transform: rotate(180deg);
}

.spinner .spinner-blade:nth-child(8) {
    -webkit-animation-delay: 0.581s;
    animation-delay: 0.581s;
    -webkit-transform: rotate(210deg);
    -ms-transform: rotate(210deg);
    transform: rotate(210deg);
}

.spinner .spinner-blade:nth-child(9) {
    -webkit-animation-delay: 0.664s;
    animation-delay: 0.664s;
    -webkit-transform: rotate(240deg);
    -ms-transform: rotate(240deg);
    transform: rotate(240deg);
}

.spinner .spinner-blade:nth-child(10) {
    -webkit-animation-delay: 0.747s;
    animation-delay: 0.747s;
    -webkit-transform: rotate(270deg);
    -ms-transform: rotate(270deg);
    transform: rotate(270deg);
}

.spinner .spinner-blade:nth-child(11) {
    -webkit-animation-delay: 0.83s;
    animation-delay: 0.83s;
    -webkit-transform: rotate(300deg);
    -ms-transform: rotate(300deg);
    transform: rotate(300deg);
}

.spinner .spinner-blade:nth-child(12) {
    -webkit-animation-delay: 0.913s;
    animation-delay: 0.913s;
    -webkit-transform: rotate(330deg);
    -ms-transform: rotate(330deg);
    transform: rotate(330deg);
}

@keyframes spinner-fade9234 {
    0% {
        background-color: #69717d;
    }

    100% {
        background-color: transparent;
    }
}
</style>
