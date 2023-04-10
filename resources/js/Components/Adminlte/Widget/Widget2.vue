<template>
    <div class="widget2 widgets">
        <h3>{{this.title}}</h3>
        <div class="widget2__container" v-if="this.is_type === 'section1'">
            <div class="widget2__container-item">
                <label class="input-file">
                    <input type="file" @change="addFile($event, 0)">
                    <span v-if="this.file1 !== null">{{ this.file1.name }}</span>
                    <span v-else>Выберите файл</span>
                </label>
                <img class="widget2__container-item-img" v-if="this.file1 !== null" :src="this.getFileUrl(this.file1)"  alt="">
            </div>

            <div class="widget2__container-item">
                <label class="input-file">
                    <input type="file" @change="addFile($event, 1)">
                    <span v-if="this.file2 !== null">{{ this.file2.name }}</span>
                    <span v-else>Выберите файл</span>
                </label>
                <img class="widget2__container-item-img" v-if="this.file2 !== null" :src="this.getFileUrl(this.file2)"  alt="">

            </div>
        </div>

        <div class="widget2__container" v-else>
            <div class="widget2__container-item">
                <label class="input-file">
                    <input type="file" disabled>
                    <span>Выберите файл</span>
                </label>
            </div>

            <div class="widget2__container-item">
                <label class="input-file">
                    <input type="file" disabled>
                    <span>Выберите файл</span>
                </label>
            </div>
        </div>
       <div class="widget2__item">
           <textarea v-model="textareaValue" class="widget2__item-textarea"></textarea>
       </div>
<!--        <ul>-->
<!--            <li v-for="(file, index) in value" :key="index">-->
<!--                {{ file.name }} <button @click="removeFile(index)">Удалить</button>-->
<!--            </li>-->
<!--        </ul>-->
    </div>
</template>

<script>
import {adminProjectStore} from "@/store/adminlte/projectStore";
export default {
    name: 'Widget2',
    props: ['index', 'title', 'is_type'],
    data: () => {
      return {
          textareaValue: '',
          file1: null,
          file2: null
      }
    },
    setup() {
        const projectStore = adminProjectStore()
        return {projectStore};
    },
    mounted() {
        if(this.is_type === 'section1'){
            let widgetData = this.getDataInStore()

            const fileLength = widgetData.files.length
            console.log(fileLength,widgetData.files)
            if (fileLength > 0){
                if (widgetData.files[0]){
                    this.file1 = widgetData.files[0]
                }
                if (widgetData.files[1]){
                    this.file2 = widgetData.files[1]
                }
            }

            this.textareaValue = widgetData.text
        }
    },
    methods: {
        getDataInStore(){
            const widget =  this.projectStore.getEmptyWidgetByIndex(this.index);
            return widget.data;
        },
        getFileUrl(file) {
            if (typeof window !== 'undefined') {
                return URL.createObjectURL(file)
            }
            return ''
        },
        // getFileInStore(){
        //     const widget =  this.projectStore.getEmptyWidgetByIndex(this.index);
        //     const fileLength = widget.data.files.length
        //     if (fileLength > 0){
        //         if (fileLength === 1){
        //             return widget.data.files[0]
        //         }
        //         if (fileLength === 2){
        //             return widget.data.files[1]
        //         }
        //     }
        //
        //     return null;
        // },
        addFile(event, fileIndex) {
            const file = event.target.files[0];

            if (fileIndex === 0){
                this.file1 = file
                this.projectStore.setFileInEmptyWidgetData(this.index, file)
            }else{
                this.file2 = file
                this.projectStore.setFileInEmptyWidgetData(this.index, file)
            }
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
.widget2{
    padding: 10px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    &__item{
        &-textarea{
            width: 100%;
        }
    }
    &__container{
        display: flex;
        justify-content: space-between;
        gap: 10px;
        &-item{
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            max-height: 200px;
            min-height: 200px;
            border: 1px dashed black;
            &-img{
                position: absolute;
                object-fit: cover;
                width: 100%;
                height: 100%;
            }
        }
        &-item:first-child{
            flex: 0 1 30%;
        }
        &-item:last-child{
            flex: 0 1 70%;
        }
    }

}

.input-file {
    position: relative;
    z-index: 2;
    display: inline-block;
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
