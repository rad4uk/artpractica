<template>
    <div class="widget-container">
        <form action="">
            <div class="form-group">
                <input type="text" v-model="this.title" class="form-group-title" placeholder="Введите заголовок">
            </div>
            <div class="form-group">
                    <div ref="dropzone" class="dropzone"></div>
<!--                    <input type="file" name="preview_image" class="custom-file-input" id="validatedCustomFile" required>-->
<!--                    <label class="custom-file-label" for="validatedCustomFile">Выберите файл...</label>-->
            </div>
        </form>
    </div>
</template>

<script>
import Dropzone from 'dropzone'
export default {
    name: "Portfolio1",
    data() {
        return {
            title: '',
            files: null,
            dropzone: null,
        };
    },
    mounted() {
        this.dropzone = new Dropzone(this.$refs.dropzone, {
            url: '/api/images/create',
            autoProcessQueue: false,
            addRemoveLinks: true,
            maxFiles: 1,
            clickable: true,
            acceptedFiles: 'image/*',
            previewTemplate: "<div class=\"dz-preview dz-file-preview\">\n" +
                "  <div class=\"dz-details\">\n" +
                "    <div class=\"dz-filename\"><span data-dz-name></span></div>\n" +
                "    <div class=\"dz-size\" data-dz-size></div>\n" +
                "    <img data-dz-thumbnail />\n" +
                "  </div>\n" +
                "  <div class=\"dz-progress\"><span class=\"dz-upload\" data-dz-uploadprogress></span></div>\n" +
                "  <div class=\"dz-error-message\"><span data-dz-errormessage></span></div>\n" +
                "</div>",
            dictRemoveFile: 'Удалить файл'
        });
    },
    methods: {
        getFiles(){
            return this.dropzone.getAcceptedFiles()
        },
        getTitle(){
            return this.title;
        }
    }
}
</script>

<style>
.dropzone{
    width: 100%;
    height: 100px;
}
.dz-message{
    height: 100%;
}
.dz-button{
    width: 100%;
    height: 100%;
    background: transparent;
    border: 1px dashed;
}
.form-group-title{
    width: 100%;
}
</style>
