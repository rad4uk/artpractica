<template>
    <div class="widget1 widgets">
        <h3>{{ this.title + ' (' + this.name + ')'}}</h3>

        <div class="widget1__item widget1-container" v-if="this.is_type === 'section1'">
            <label class="input-file">
                <input class="widget1__item-input" type="file" ref="fileInput" @change="addFile">
                <span v-if="this.file !== null">{{ this.file.name }}</span>
                <span v-else>Выберите файл</span>
            </label>
            <img class="widget1__item-img" v-if="this.file !== null" :src="this.getFileUrl(this.file)"  alt="">
        </div>

        <div class="widget1__item widget1-container" v-else>
            <label class="input-file">
                <input class="widget1__item-input" type="file" disabled>
                <span>Выберите файл</span>
            </label>
        </div>

        <div class="widget1__item">
            <textarea v-model="textareaValue" class="widget1__item-textarea"></textarea>
        </div>
    </div>
</template>

<script>
import {adminProjectStore} from "@/store/adminlte/projectStore";

export default {
    name: 'Widget1',
    props: ['index', 'title', 'is_type', 'name'],
    data: () => {
        return {
            textareaValue: '',
            file: null,
        }
    },
    setup() {
        const projectStore = adminProjectStore()
        return {projectStore};
    },
    mounted() {
        if(this.is_type === 'section1'){
            let widgetData = this.getDataInStore()
            // console.log(widgetData.files)
            if (widgetData.files.length > 0){
                this.file = widgetData.files[0]
            }
            this.textareaValue = widgetData.text
        }
    },
    methods: {
        getFileUrl(file) {
            if (typeof window !== 'undefined') {
                return URL.createObjectURL(file)
            }
            return ''
        },

        getDataInStore(){
            const widget =  this.projectStore.getEmptyWidgetByIndex(this.index);
            return widget.data;
        },
        addFile(evt) {
            const file = evt.target.files[0];
            console.log(JSON.stringify(evt.target.files[0]))
            this.file = file
            this.projectStore.setOneFileInEmptyWidgetData(this.index, file)
        },
    },
    watch: {
        textareaValue(newValue){
            this.projectStore.setTextInEmptyWidgetData(this.index, newValue)
        }
    }
};

</script>
<style lang="scss" scoped>
.widget1{
    padding: 10px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    &__item{
        &-textarea{
            width: 100%;
        }
        &-input{
            position: absolute;
        }
        &-img{
            height: 100%;
            width: 100%;
            object-fit: cover;
        }
    }
}
.widget1-container{
    min-width: 100%;
    min-height: 50px;
    max-height: 200px;
    width: 100%;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px dashed black;
}
.input-file {
    position: absolute;
    display: inline-block;
    margin-bottom: 0;
}
.input-file span {
    position: relative;
    display: inline-block;
    cursor: pointer;
    outline: none;
    text-decoration: none;
    font-size: 14px;
    vertical-align: middle;
    color: rgb(255 255 255);
    text-align: center;
    border-radius: 4px;
    background-color: #419152;
    line-height: 22px;
    height: 40px;
    padding: 10px 20px;
    box-sizing: border-box;
    border: none;
    margin: 0;
    transition: background-color 0.2s;
}
.input-file input[type=file] {
    position: absolute;
    z-index: -1;
    opacity: 0;
    display: block;
    width: 0;
    height: 0;
}

/* Focus */
.input-file input[type=file]:focus + span {
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
}

/* Hover/active */
.input-file:hover span {
    background-color: #59be6e;
}
.input-file:active span {
    background-color: #2E703A;
}

/* Disabled */
.input-file input[type=file]:disabled + span {
    background-color: #eee;
}
</style>
