<template>
    <div ref="dropzone" class="dropzone"></div>
</template>

<script>
import Dropzone from "dropzone";

export default {
    name: "CustomDropzone",
    data: () => {
        return {
            dropzone: null,
        }
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
    }
}
</script>

<style scoped>

</style>
