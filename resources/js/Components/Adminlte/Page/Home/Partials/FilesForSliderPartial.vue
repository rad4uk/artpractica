<template>

    <div class="tab-pane fade active show card-body" id="custom-tabs-three-home" role="tabpanel"
         aria-labelledby="custom-tabs-three-home-tab">

        <div class="card card-blue card-outline collapsed-card">
            <div class="card-header">
                <h3 class="card-title">Слайдер</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body" style="display: none;">
                <div class="form-group collection-wrapper">
                    <div class="secondSectionDescription" id="secondSectionDescription">
                        <div class="row collection-row">
                            <div class="form-container">
                                <div class="form-group slider-title">
                                    <label for="inputName">Заголовок</label>
                                    <input type="text" id="inputName" v-model="title" class="form-control">
                                </div>
                                <div class="form-group form-slider">
                                    <h1>Загрузка файлов</h1>
                                    <div class="dropzone" ref="dropzone">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


</template>

<script>

import Dropzone from "dropzone";
import {adminHomePageStore} from "@/store/adminlte/homePageStore";

export default {
    name: "FilesForSliderPartial",
    props: ['slider_object_name', 'is_type_page', 'data', 'dir_path'],
    components: {},
    data() {
        return {
            title: ''
        };
    },
    setup() {
        const homePageStore = adminHomePageStore()

        return {homePageStore}
    },
    async beforeMount() {
        if (this.is_type_page === 'edit'){
            if (this.data !== null){
                this.title = this.data.title
            }
            let images = []

            if (this.data.files.length > 0){
                for (let i = 0; i < this.data.files.length; i++) {
                    let imageName = this.data.files[i]
                    let image = await this.fetchFile(this.dir_path, imageName)
                    this.dropzone.addFile(image)
                    images.push(image)
                }

            }
        }
    },
    mounted() {
        this.dropzone = new Dropzone(this.$refs.dropzone, {
            url: "/api/upload",
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 10,
            maxFiles: 50,
            acceptedFiles: "image/*",
            dictDefaultMessage: "Перетащите файлы сюда или кликните для выбора файлов",
            previewTemplate:
                '<div class="dz-preview dz-file-preview">' +
                '<div class="dz-image"><img data-dz-thumbnail=""></div>' +
                '<div class="dz-details">' +
                '<div class="dz-filename"><span data-dz-name></span></div>' +
                '<div class="dz-size" data-dz-size></div>' +
                '<div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>' +
                '<div class="dz-error-message"><span data-dz-errormessage></span></div>' +
                '</div>' +
                '<div class="dz-success-mark"><span>✔</span></div>' +
                '<div class="dz-error-mark"><span>✘</span></div>' +
                '<div class="dz-remove"><button data-dz-remove class="btn btn-danger">Удалить</button></div>' +
                '</div>',
            init: function () {
                const self = this;
                this.on("addedfile", function (file) {
                    self.files.push(file);
                    file.previewElement.querySelector("[data-dz-remove]").addEventListener("click", function () {
                        self.removeFile(file);
                    });
                });
                this.on("removedfile", function (file) {
                    const index = self.files.findIndex(function (item) {
                        return item.name === file.name && item.size === file.size && item.type === file.type;
                    });
                    if (index !== -1) {
                        self.files.splice(index, 1);
                    }
                });
            }
        });

        this.dropzone.on("addedfile", file => {
            this.homePageStore.setSliderFilesDataByName(this.slider_object_name, file)
        });
        this.dropzone.on("removedfile", file => {
            const sliderData = this.homePageStore.getSliderDataByName(this.slider_object_name)

            sliderData.files.forEach((item, index) => {
                if (item.name === file.name && item.size === file.size && item.type === file.type) {
                    this.homePageStore.removeSliderFilesDataByIndex(this.slider_object_name, index)
                }
            });
        });
    },
    methods: {
        uploadFiles() {
            this.dropzone.processQueue();
        },
        async fetchFile(dirPath, fileName) {
            return await fetch(`${dirPath}/${fileName}`)
                .then(response => response.blob())
                .then(blob => new File([blob], fileName, { type: blob.type }));
        },
    },
    watch: {
        title(newValue){
            this.homePageStore.setSliderTitleDataByName(this.slider_object_name, newValue)
        }
    }
}
</script>

<style lang="scss">
.dropzone {
    border: 2px dashed #0087F7;
    border-radius: 5px;
    padding: 20px;
    text-align: center;
    font-size: 14px;
    color: #0087F7;
    margin-bottom: 20px;
}

.files-list {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.dz-message {
    .dz-button {
        color: #fff;
        background-color: #28a745;
        border-color: #28a745;
        box-shadow: none;
        display: inline-block;
        font-weight: 400;
        text-align: center;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 0.25rem;
        transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }
}

.form-container {
    display: flex;
    flex-direction: column;
    flex: 0 1 100%;
}

.form-slider {
    width: 100%;
}

.slider-title {
    width: 100%;
}

.dz-clickable {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    gap: 10px;

    .dz-default {
        flex: 0 1 100%;
        width: 100%;
        margin-bottom: 20px;
    }

}

.dz-success-mark {
    height: 0;
}

.dz-error-mark {
    height: 0;
}

.dz-preview {

    .dz-image {
        img {
            //width: 100%;
            //height: 100%;
        }
    }
}
</style>
