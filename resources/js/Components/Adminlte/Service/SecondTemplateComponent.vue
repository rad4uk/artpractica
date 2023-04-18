<template>
    <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
        <form action="">
<!--            <div class="form-group">-->
<!--                <label for="inputName">Загаловок к первой секции</label>-->
<!--                <input type="text" id="inputName" name="subtitle" class="form-control" v-model="titleValue">-->
<!--            </div>-->

            <div class="card card-blue card-outline collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">ЭТАПЫ РАБОТЫ</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body" style="display: none;">
                    <div class="form-group collection-wrapper">
                        <div class="secondSectionDescription" id="secondSectionDescription">
                            <div class="row collection-row"
                                 style="border-bottom: 1px solid #007bff; margin-bottom: 10px"
                                 v-for="(item, index) in items" :key="index"
                            >
                                <div class="form-group col-11" >
                                    <div class="form-group">
                                        <label>Заголово</label>
                                        <input type="text" class="form-control" v-model="item.input" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label>Описание</label>
                                        <textarea class="form-control" rows="3" v-model="item.textarea" placeholder="" data-dl-input-translation="true"></textarea>
                                    </div>
                                </div>

                                <div class="form-group col-1 col-sm-1 table-trash"
                                     @click="this.removeInputAndTextarea(index)"
                                     style="display: flex; align-items: center">
                                    <a class="btn btn-danger btn-sm remove-collection-item"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </div>

                        </div>

                    </div>
                    <button type="button" class="btn btn-info add_item_link"
                            data-collection-holder-class="secondSectionDescription"
                            @click.prevent="addInputAndTextarea"
                    >
                        Добавить запись
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label for="inputName">Загаловок ко второй секции</label>
                <input type="text" id="inputName" name="subtitle" class="form-control" v-model="second_section_title">
            </div>

            <div class="form-group">
                <label for="inputDescription">Фото ко второй секции</label>
                <div class="custom-file">
                    <input type="file" name="apartment_images"
                           @change="this.addFile"
                           class="custom-file-input" id="validatedCustomFile" required>
                    <label class="custom-file-label" for="validatedCustomFile">Выберите файл</label>
                </div>
            </div>

            <div class="form-group">
                <label for="inputDescription">Описание ко второй секции</label>
                <ckeditor :editor="editor" v-model="second_section_description" :config="editorConfig"></ckeditor>
            </div>

            <div class="form-group">
                <label for="inputName">Загаловок к третей секции</label>
                <input type="text" id="inputName" name="subtitle" class="form-control" v-model="third_section_title">
            </div>

            <div class="form-group">
                <label for="inputDescription">Описание ко третей секции (используйте нумерованный список)</label>
                <ckeditor :editor="editor" v-model="third_section_description" :config="editorConfig"></ckeditor>
            </div>

            <div class="form-group form-check-inline">
                <label class="form-check-label">
                    <input type="checkbox" name="status" class="form-check-input" v-model="on" @change="this.setTemplate(this.on)">Выбрать текущий шаблон
                </label>
            </div>
        </form>
    </div>
</template>

<script>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import {adminServicesStore} from "@/store/adminlte/servicesStore";
export default {
    name: "SecondTemplateComponent",
    props: ['template_data', 'service', 'file_dir'],
    data() {
        return {
            titleValue: '',
            second_section_title: '',
            second_section_image: null,
            second_section_description: '',

            third_section_title: '',
            third_section_description: '',

            itemIndex: null,
            on: false,
            items: [],
            editor: ClassicEditor,
            editorConfig: {
                // The configuration of the editor.
            }
        };
    },
    async mounted() {
        if (this.service && this.service.name === 'secondTemplate') {
            this.items = this.template_data.first_section_description
            this.second_section_title = this.template_data.second_section_title
            const file = await this.fetchFile(this.file_dir, this.template_data.second_section_image)
            this.servicesStore.setSecondTemplateSecondSectionImage(file)
            this.second_section_description = this.template_data.second_section_description
            this.third_section_title = this.template_data.third_section_title
            this.third_section_description = this.template_data.third_section_description

            this.on = true
        }
    },
    setup() {
        const servicesStore = adminServicesStore()

        return {servicesStore}
    },
    methods: {
        async fetchFile(dirPath, fileName) {
            return await fetch(`${dirPath}/${fileName}`)
                .then(response => response.blob())
                .then(blob => new File([blob], fileName, { type: blob.type }));
        },
        setTemplate(isActive){
            if (isActive){
                const template = this.servicesStore.getSecondTemplate
                this.servicesStore.setCurrentTemplate(template)
            }else{
                this.servicesStore.setCurrentTemplate(null)
            }
        },
        addFile(event){
            this.second_section_image = event.target.files[0]
            this.servicesStore.setSecondTemplateSecondSectionImage(event.target.files[0])
        },
        addInputAndTextarea() {
            this.items.push({ input: "", textarea: "" });
            if (this.itemIndex !== null || this.items.length > 0){
                this.itemIndex++
            }
        },
        removeInputAndTextarea(index){
            this.items.splice(index,1);
            if (this.itemIndex !== null && this.items.length > 0){
                this.itemIndex--
            }else{
                this.itemIndex = null
            }
        }
    },
    watch: {
        second_section_title(value){
            this.servicesStore.setSecondTemplateSecondSectionTitle(value)
        },
        second_section_description(value){
            this.servicesStore.setSecondTemplateSecondSectionDescription(value)
        },
        third_section_title(value){
            this.servicesStore.setSecondTemplateThirdSectionTitle(value)
        },
        third_section_description(value){
            this.servicesStore.setSecondTemplateThirdSectionDescription(value)
        },

        itemIndex(value){
            if (value !== null){
                this.servicesStore.setSecondTemplateFirstSectionDescription(this.items)
            }else{
                this.servicesStore.setSecondTemplateFirstSectionDescription([])
            }
        }
    }
}
</script>

<style scoped>

</style>
