<template>
    <div class="gallery">
        <div class="mb-3">
            <div ref="dropzone" class="gallery__dropzone"></div>
            <input type="text" class="gallery__dropzone-alt" placeholder="Название изображения"
                   v-model="this.alt">
            <input type="submit"
                   @click.prevent="store"
                   class="btn btn-primary gallery__dropzone-btn"
                   :value="buttonValue"
                   :disabled="disabled">
        </div>
        <div
            v-if="message.isResponse"
            :class="'position-relative alert alert-' + message.status"
            v-for="text in message.textData"
        >
            {{ text }}
            <span @click='closeAlert' aria-hidden="true" class="close-alert float-right position-absolute" style="padding: 0 10px;right: 10px; cursor: pointer">x</span>
        </div>
    </div>
</template>

<script>
import Dropzone from 'dropzone'
import {useGalleryStore} from "@/store/galleryStore";

export default {
    name: "Form",
    data: function () {
        return {
            alt: '',
            dropzone: null,
            images: null,
            disabled: false,
            buttonValue: 'Загрузить',
            message: {
                textData: [],
                isResponse: false,
                status: 'danger',
            }
        }
    },
    setup() {
        const galleryStore = useGalleryStore()

        return { galleryStore }
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
        closeAlert(){
            this.message.isResponse = false
        },
        async store() {
            this.buttonValue = 'Идет загрузка...'
            this.disabled = true
            const images = new FormData()
            const files = this.dropzone.getAcceptedFiles()
            files.forEach(file => {
                images.append('images[]', file)
                this.dropzone.removeFile(file)
            })

            images.append('alt', this.alt)

            await axios.post('/api/images/create', images)
                .then(res => {
                    console.log(res.data)
                    if (res.data.message === 'success' && res.status === 200) {
                        this.message.textData = res.data.textData
                        this.message.isResponse = true
                        this.message.status = res.data.message
                        this.galleryStore.setGalleryImages(res.data.data)
                        this.alt = ''
                    }
                })
                .catch(error => {
                    const response = error.response
                    if (response.data.errors.images.length > 0) {
                        this.message.isResponse = true
                        this.message.textData = response.data.errors.images
                    }
                }).finally(() => {
                    this.buttonValue = 'Загрузить'
                    this.disabled = false

                    setTimeout(() => {
                        this.message.status = 'danger';
                        this.message.textData = [];
                        this.message.isResponse = false;
                    }, 8000)
            })
        },

    }
}
</script>

<style scoped>
.gallery {
    width: 25%;
    margin-left: 15.5px;
}

@media (max-width: 1200px) {
    .gallery{
        width: 50%;
    }
}
@media (max-width: 576px) {
    .gallery{
        width: 92%;
    }
}
.gallery .mb-3{
    display: flex;
    flex-direction: column;
}
.gallery__dropzone-alt{
    margin-bottom: 20px;
    padding: 5px;
}
.gallery__dropzone-btn{
    width: 35%;
}

.gallery__dropzone:hover {
    cursor: pointer;
}
.close-alert:hover{
    border: 1px solid #ffffff;
    border-radius: 5px;
    box-shadow: 5px 5px 5px #0a001f;
}

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
.gallery__dropzone:before{
    font-size: 1.2rem;
    content: 'Выберите или перетащите изображение';
}


</style>
