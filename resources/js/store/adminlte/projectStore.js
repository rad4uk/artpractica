import { defineStore } from 'pinia'
import Widget1 from "../../Components/Adminlte/Widget/Widget1.vue";
import Widget2 from "../../Components/Adminlte/Widget/Widget2.vue";
import Widget3 from "../../Components/Adminlte/Widget/Widget3.vue";
import {markRaw} from "vue";
import {ref} from "vue";
export const adminProjectStore = defineStore('projectStore', {
    state: () => ({
        dragItem: null,
        dragItemIndex: null,
        emptyWidgets: [],
        widgets: [
            {
                id: 1,
                name: 'widget1',
                component: markRaw(Widget1),
                title: 'Загрузить одно фото',
                data: {
                    text: '',
                    files: [],
                }
            },
            {
                id: 2,
                name: 'widget2',
                component: markRaw(Widget2),
                title: 'Загрузить два фото',
                data: {
                    text: null,
                    files: [],
                }
            },
            {
                id: 3,
                name: 'widget3',
                component: markRaw(Widget3),
                title: 'Заголовок к секции',
                data: {
                    title: null
                }
            },
        ],
    }),
    getters: {
        getWidgets: state => {
            return state.widgets
        },
        getEmptyWidgets: state => {
            return state.emptyWidgets
        },
        getEmptyWidgetByIndex: state => {
            return index => state.emptyWidgets[index]
        }
    },
    actions: {
        setTitleInEmptyWidgetData(index, text){
          this.emptyWidgets[index].data.text = text
        },
        setFileInEmptyWidgetData(index, file){
            this.emptyWidgets[index].data.files.push(file)
        },
        setOneFileInEmptyWidgetData(index, file){
            this.emptyWidgets[index].data.files[0] = file
        },
        setEmptyWidgetData(index, file){
            this.emptyWidgets[index].data.files.push(file)
        },
        setEmptyWidgetFileByIndex(index, file, fileIndex){
            if (this.emptyWidgets[index].data){
                if(this.emptyWidgets[index].data[0].files){
                    this.emptyWidgets[index].data[0].files[fileIndex] = file
                }
            }
        },
        setToEmptyWidget(newWidget){
            this.emptyWidgets.push(newWidget)
        },
        removeToEmptyWidget(index){
            this.emptyWidgets.splice(index, 1);
        },
        dragItemStart(index){
            this.dragItem = this.emptyWidgets[index];
            this.dragItemIndex = index;
        },
        dropItem(index){
            this.emptyWidgets.splice(this.dragItemIndex, 1);
            this.emptyWidgets.splice(index, 0, this.dragItem);
            this.dragItemIndex = null;
            this.dragItem = null;
        },
        onDrop(newWidget){
            this.emptyWidgets.push(newWidget)
        }

    }
})
