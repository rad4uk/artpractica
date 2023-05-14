<template>
    <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel"
         aria-labelledby="custom-tabs-three-home-tab">
        <form>
            <div class="form-group">
                <label for="inputName">Имя автора</label>
                <input type="text" id="inputName" name="authorName" class="form-control" v-model="authorName">
            </div>
            <div class="form-group">
                <label for="inputName">Текст под автором</label>
                <input type="text" id="inputName" name="authorDescription" class="form-control"
                       v-model="authorDescription">
            </div>


            <div class="form-group">
                <label for="inputDescription">Описание</label>
                <ckeditor :editor="editor" v-model="description" :config="editorConfig"></ckeditor>
            </div>

            <div class="form-group">
                <label for="exampleInputFile">Изображение автора</label>
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
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export default {
    name: "FirstSectionComponent",
    props: ['page', 'is_type_page'],
    data: () => {
        return {
            authorName: '',
            authorDescription: '',
            description: '',
            image: '',
            editor: ClassicEditor,
            editorConfig: {
                // The configuration of the editor.
            }
        }
    },
    async beforeMount() {
        if (this.is_type_page === 'edit' && this.page.first_section_data) {
            const firstSectionData = JSON.parse(this.page.first_section_data)
            if (firstSectionData.authorName) {
                this.authorName = firstSectionData.authorName
            }
            if (firstSectionData.authorDescription) {
                this.authorDescription = firstSectionData.authorDescription
            }
            if (firstSectionData.description) {
                this.description = firstSectionData.description
            }
            if (firstSectionData.image) {
                const file = await this.fetchFile(this.page.dirPath, firstSectionData.image)
                this.image = file
                this.pageStore.setFirstSectionDataImage(file)
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
            this.pageStore.setFirstSectionDataImage(file)
        }
    },
    watch: {
        authorName(value) {
            this.pageStore.setFirstSectionDataAuthorName(value)
        },
        authorDescription(value) {
            this.pageStore.setFirstSectionDataAuthorDescription(value)
        },
        description(value) {
            this.pageStore.setFirstSectionDataDescription(value)
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
