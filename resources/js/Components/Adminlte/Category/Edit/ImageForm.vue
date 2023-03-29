<template>
    <div class="gallery m-lg-3 w-50">
        <div class="mb-3">
            <div ref="dropzone" class="gallery__dropzone"></div>
        </div>
        <div
            v-if="this.getIsResponse()"
            :class="'position-relative alert alert-' + this.getStatus()"
            v-for="text in this.getTextData()"
        >
            {{ text }}
            <span @click='closeAlert' aria-hidden="true" class="close-alert float-right position-absolute" style="padding: 0 10px;right: 10px; cursor: pointer">x</span>
        </div>
    </div>

</template>

<script>
import Dropzone from "dropzone";

import {adminCategoryStore} from "@/store/categoryStore";
import {uploadCategoryImageStore} from "@/store/uploadCategoryImageStore";
export default {
    name: "ImageForm",
    setup() {
        const categoryStore = adminCategoryStore()
        const categoryImageStore = uploadCategoryImageStore()

        return { categoryStore, categoryImageStore }
    },
    mounted() {
        const dropzone = new Dropzone(this.$refs.dropzone, {
                url: '/api/category/image/create',
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

        this.categoryImageStore.setDropzone(dropzone)
    },
    methods: {
        closeAlert(){
            this.categoryImageStore.setIsResponse(false)
        },
        getIsResponse(){
            return this.categoryImageStore.getIsResponse
        },
        getStatus(){
            return this.categoryImageStore.getStatus
        },
        getTextData(){
            return this.categoryImageStore.getTextData
        },
    }
}
</script>

<style>
.gallery__dropzone:hover{
    cursor: pointer;
}
.gallery__dropzone{
    padding: 10px 20px;
    outline: 2px dashed #5d5d5d;
    margin-bottom: 20px;
    min-height: 100px;
    text-align: center;
}
.gallery__dropzone .dz-preview{
    margin-top: 20px;
}
.gallery__dropzone .dz-preview .dz-success-mark{
   display: none;
}
.gallery__dropzone .dz-preview .dz-error-mark{
    display: none;
}
.gallery__dropzone .dz-preview .dz-image{
    padding-bottom: 20px;
}
.gallery__dropzone .dz-preview .dz-size{
    padding-bottom: 20px;
}
.gallery__dropzone .dz-preview .dz-details{
    padding-bottom: 20px;
}
.gallery__dropzone::before{
    content: 'Загрузить изображение';
}
</style>
