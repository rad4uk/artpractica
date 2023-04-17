<template>
    <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
        <form action="">
            <div class="form-group">
                <label for="inputName">Загаловок к первой секции</label>
                <input type="text" id="inputName" name="subtitle" class="form-control" value="">
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
                <input type="text" id="inputName" name="subtitle" class="form-control" value="">
            </div>

            <div class="form-group">
                <label for="inputDescription">Фото ко второй секции</label>
                <div class="custom-file">
                    <input type="file" name="apartment_images" multiple class="custom-file-input" id="validatedCustomFile" required>
                    <label class="custom-file-label" for="validatedCustomFile">Выберите файл</label>
                </div>
            </div>

            <div class="form-group">
                <label for="inputDescription">Описание ко второй секции</label>
                <ckeditor :editor="editor" v-model="editorDataSecondSection" :config="editorConfig"></ckeditor>
            </div>

            <div class="form-group">
                <label for="inputName">Загаловок к третей секции</label>
                <input type="text" id="inputName" name="subtitle" class="form-control" value="">
            </div>

            <div class="form-group">
                <label for="inputDescription">Описание ко второй секции (используйте нумерованный список)</label>
                <ckeditor :editor="editor" v-model="editorDataThirdSection" :config="editorConfig"></ckeditor>
            </div>
        </form>
    </div>
</template>

<script>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

export default {
    name: "SecondTemplateComponent",
    data() {
        return {
            items: [],
            editor: ClassicEditor,
            editorDataSecondSection: '',
            editorDataThirdSection: '',
            editorConfig: {
                // The configuration of the editor.
            }
        };
    },
    methods: {
        addInputAndTextarea() {
            this.items.push({ input: "", textarea: "" });
        },
        removeInputAndTextarea(index){
            this.items.splice(index,1);
        }
    },
}
</script>

<style scoped>

</style>
