<template>
    <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel"
         aria-labelledby="custom-tabs-three-home-tab">
        <form>
            <div class="form-group">
                <label for="inputName">Заголовок ко второй секции</label>
                <input type="text" id="inputName" name="authorName" class="form-control" v-model="title">
            </div>

            <div class="form-group">
                <label for="inputName">Описание ко второй секции</label>
                <textarea id="inputName" name="description" class="form-control" v-model="description"></textarea>
            </div>

            <div class="form-group">
                <label for="exampleInputFile">Изображение ко второй секции</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" @change="addFile($event)">
                        <label class="custom-file-label" for="exampleInputFile">{{ this.getFileInputTitle }}</label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import {adminAboutPageStore} from "@/store/adminlte/aboutPageStore";
export default {
    name: "SecondSectionComponent",
    props: ['page', 'is_type_page'],
    data: () => {
        return {
            title: '',
            description: '',
            image: ''
        }
    },
    async beforeMount() {
        if (this.is_type_page === 'edit' && this.page.second_section_data) {
            const secondSectionData = JSON.parse(this.page.second_section_data)
            if (secondSectionData.title) {
                this.title = secondSectionData.title
            }
            if (secondSectionData.description) {
                this.description = secondSectionData.description
            }
            if (secondSectionData.image) {
                const file = await this.fetchFile(this.page.dirPath, secondSectionData.image)
                this.image = file
                this.pageStore.setSecondSectionDataImage(file)
            }
        }
    },
    setup() {
        const pageStore = adminAboutPageStore()

        return {pageStore}
    },
    methods: {
        async fetchFile(dirPath, fileName) {
            return await fetch(`${dirPath}/${fileName}`)
                .then(response => response.blob())
                .then(blob => new File([blob], fileName, { type: blob.type }));
        },
        addFile(event) {
            const file = event.target.files[0];
            this.image = file;
            this.pageStore.setSecondSectionDataImage(file)
        }
    },
    watch: {
        title(value) {
            this.pageStore.setSecondSectionDataTitle(value)
        },
        description(value) {
            this.pageStore.setSecondSectionDataDescription(value)
        }
    },
    computed: {
        getFileInputTitle: function (){
            return this.image instanceof File ? this.image.name : 'Выберите файл'
        }
    }
}
</script>

<style scoped>

</style>
