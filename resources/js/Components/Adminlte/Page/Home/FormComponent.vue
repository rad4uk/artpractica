<template>
    <form action="" method="POST" enctype="multipart/form-data">
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

        <first-form-partial
            :is_type_page="this.is_type_page"
            :data="this.first_section_data"
        ></first-form-partial>
        <second-form-partial
            :is_type_page="this.is_type_page"
            :data="this.second_section_data"
        ></second-form-partial>

        <files-for-slider-partial
            :slider_object_name="this.firstSliderName"
            :is_type_page="this.is_type_page"
            :data="this.firstSliderData"
            :dir_path="this.dir_path"
        ></files-for-slider-partial>
        <files-for-slider-partial
            :slider_object_name="this.secondSliderName"
            :is_type_page="this.is_type_page"
            :data="this.secondSliderData"
            :dir_path="this.dir_path"
        ></files-for-slider-partial>
        <files-for-slider-partial
            :slider_object_name="this.thirdSliderName"
            :is_type_page="this.is_type_page"
            :data="this.thirdSliderData"
            :dir_path="this.dir_path"
        ></files-for-slider-partial>
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
import FirstFormPartial from "./Partials/FirstFormPartial.vue";
import SecondFormPartial from "./Partials/SecondFormPartial.vue";
import FilesForSliderPartial from "./Partials/FilesForSliderPartial.vue";

import {adminHomePageStore} from "@/store/adminlte/homePageStore";

export default {
    name: "FormComponent",
    props: ['action', 'page', 'dir_path', 'is_type_page'],
    components: {
        FirstFormPartial,
        SecondFormPartial,
        FilesForSliderPartial
    },
    data: () => {
        return {
            first_section_data: null,
            second_section_data: null,
            firstSliderData: null,
            secondSliderData: null,
            thirdSliderData: null,
            firstSliderName: 'firstSliderData',
            secondSliderName: 'secondSliderData',
            thirdSliderName: 'thirdSliderData',
            errors: [],
            title: '',
            description: '',
            slug: '',
            status: '',
        }
    },
    beforeMount() {
        this.first_section_data = this.homePageStore.getFirstSectionData
        this.second_section_data = this.homePageStore.getSecondSectionData
      if (this.is_type_page === 'edit'){
          this.first_section_data = this.page.first_section_data
          this.second_section_data = this.page.second_section_data
          this.title = this.page.title
          this.description = this.page.description
          this.slug = this.page.slug
          this.status = this.page.status === 1


          if (this.page.sliders_data !== null){
              const sliders_data = JSON.parse(this.page.sliders_data)
              if(sliders_data.firstSliderData){
                  this.firstSliderData = sliders_data.firstSliderData
              }
              if(sliders_data.secondSliderData){
                  this.secondSliderData = sliders_data.secondSliderData
              }
              if(sliders_data.thirdSliderData){
                  this.thirdSliderData = sliders_data.thirdSliderData
              }
          }
      }
    },
    setup() {
        const homePageStore = adminHomePageStore()

        return {homePageStore}
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
            if (this.homePageStore.getMetaData.title.length < 2) {
                this.errors.push('Заполните Мета Заголовок')
            }
            if (this.homePageStore.getMetaData.description.length < 2) {
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
            formData.append('meta_title', this.homePageStore.getMetaData.title)
            formData.append('meta_description', this.homePageStore.getMetaData.description)
            formData.append('first_section_data', JSON.stringify(this.homePageStore.getFirstSectionData))
            formData.append('second_section_data', JSON.stringify(this.homePageStore.getSecondSectionData))

            const firstSliderData = this.homePageStore.getSliderDataByName(this.firstSliderName)
            const secondSliderData = this.homePageStore.getSliderDataByName(this.secondSliderName)
            const thirdSliderData = this.homePageStore.getSliderDataByName(this.thirdSliderName)

            formData.append('firstSliderData[title]', firstSliderData.title)
            firstSliderData.files.forEach((file) => {
                formData.append('firstSliderData[files][]', file)
            })


            formData.append('secondSliderData[title]', secondSliderData.title)
            secondSliderData.files.forEach((file) => {
                formData.append('secondSliderData[files][]', file)
            })


            formData.append('thirdSliderData[title]', thirdSliderData.title)
            thirdSliderData.files.forEach((file) => {
                formData.append('thirdSliderData[files][]', file)
            })


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
