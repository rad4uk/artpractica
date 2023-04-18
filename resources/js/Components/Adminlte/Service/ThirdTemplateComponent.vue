<template>
    <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
        <form action="">
            <div class="form-group">
                <label for="inputName">Загаловок к первой секции</label>
                <input type="text" id="inputName" name="subtitle" class="form-control" v-model="second_section_title">
            </div>

            <div class="form-group">
                <label for="inputDescription">Описание к первой секции</label>
                <textarea id="inputDescription" name="description" class="form-control" rows="4"
                          v-model="second_section_description"
                          placeholder="начните вводить текст"></textarea>
            </div>

            <div class="form-group">
                <label for="inputDescription">Фото к первой секции</label>
                <div class="custom-file">
                    <input type="file" name="apartment_images"
                           @change="this.addedSecondSectionImage"
                           class="custom-file-input" id="validatedCustomFile" required>
                    <label class="custom-file-label" for="validatedCustomFile">Выберите файл</label>
                </div>
            </div>

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
                                        <label>Заголовок</label>
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
                <input type="text" id="inputName" name="subtitle" class="form-control" v-model="third_section_title">
            </div>

            <div class="form-group">
                <label for="inputDescription">Описание ко второй секции</label>
                <textarea id="inputDescription" name="description" class="form-control" rows="4"
                          v-model="third_section_description"
                          placeholder="начните вводить текст"></textarea>
            </div>

            <div class="form-group">
                <label for="inputDescription">Изображение ко второй секции (выберите 3 изображения)</label>
                <div class="custom-file">
                    <input type="file" name="apartment_images" multiple
                           @change="this.addedThirdSectionFiles"
                           class="custom-file-input" id="validatedCustomFile" required>
                    <label class="custom-file-label" for="validatedCustomFile">Выберите файлы</label>
                </div>
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
import {adminServicesStore} from "@/store/adminlte/servicesStore";
export default {
    name: "ThirdTemplateComponent",
    props: ['template_data', 'service', 'file_dir'],
    data() {
        return {
            second_section_title: '',
            second_section_description: '',

            third_section_title: '',
            third_section_description: '',

            itemIndex: null,
            on: false,
            items: [],
        };
    },
    async mounted() {
        if (this.service && this.service.name === 'thirdTemplate') {
            this.second_section_title = this.template_data.second_section_title
            this.second_section_description = this.template_data.second_section_description

            this.third_section_title = this.template_data.third_section_title
            this.third_section_description = this.template_data.third_section_description

            const file = await this.fetchFile(this.file_dir, this.template_data.second_section_image)
            this.servicesStore.setThirdTemplateSecondSectionImage(file)
            let images = []
            this.template_data.third_section_images.map(async (imageName) => {
                let image = await this.fetchFile(this.file_dir, imageName)
                images.push(image)
            })
            this.servicesStore.setThirdTemplateThirdSectionImages(images)

            this.items = this.template_data.first_section_description

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
        addedSecondSectionImage(event){
            this.servicesStore.setThirdTemplateSecondSectionImage(event.target.files[0])
        },
        addedThirdSectionFiles(event){
            let newFiles = []
            const files = event.target.files
            for (let i = 0; i < files.length; i++) {
                newFiles.push(files[i])
            }
            this.servicesStore.setThirdTemplateThirdSectionImages(newFiles)
        },
        setTemplate(isActive){
            if (isActive){
                const template = this.servicesStore.getThirdTemplate
                this.servicesStore.setCurrentTemplate(template)
            }else{
                this.servicesStore.setCurrentTemplate(null)
            }
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
        itemIndex(value){
            if (value !== null){
                this.servicesStore.setThirdTemplateFirstSectionDescription(this.items)
            }else{
                this.servicesStore.setThirdTemplateFirstSectionDescription([])
            }
        },
        second_section_title(value){
            this.servicesStore.setThirdTemplateSecondSectionTitle(value)
        },
        second_section_description(value){
            this.servicesStore.setThirdTemplateSecondSectionDescription(value)
        },
        third_section_title(value){
            this.servicesStore.setThirdTemplateThirdSectionTitle(value)
        },
        third_section_description(value){
            this.servicesStore.setThirdTemplateThirdSectionDescription(value)
        },
    }
}
</script>

<style scoped>

</style>
