import { defineStore } from 'pinia'

export const adminProjectStore = defineStore('projectStore', {
    state: () => ({
        dragItem: null,
        dragItemIndex: null,
        metaData: {
            title: '',
            description: ''
        },
        emptyWidgets: [],
        widgets: [
            {
                id: 1,
                name: 'Widget1',
                // component: markRaw(Widget1),
                widgetTitle: 'Прямоугольное изображение',
                data: {
                    text: '',
                    files: [],
                }
            },
            {
                id: 2,
                name: 'Widget2',
                // component: markRaw(Widget2),
                widgetTitle: 'Два изображение шириной 30% на 70% с описанием',
                data: {
                    text: '',
                    files: [],
                }
            },
            {
                id: 3,
                name: 'Widget3',
                // component: markRaw(Widget3),
                widgetTitle: 'Два изображение шириной 50% на 50% с описанием',
                data: {
                    text: '',
                    files: [],
                }
            },
            {
                id: 4,
                name: 'Widget4',
                // component: markRaw(Widget4),
                widgetTitle: 'Заголовок',
                data: {
                    title: ''
                }
            },
            {
                id: 5,
                name: 'Widget5',
                // component: markRaw(Widget5),
                widgetTitle: 'Квадратное изображение с описанием',
                data: {
                    text: '',
                    files: [],
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
        },
        getMetaData: state => {
            return state.metaData
        },
    },
    actions: {
        setMetaDataTitle(value){
            this.metaData.title = value
        },
        setMetaDataDescription(value){
            this.metaData.description = value
        },

        setTitleInEmptyWidgetData(index, title){
          this.emptyWidgets[index].data.title = title
        },
        setTextInEmptyWidgetData(index, text){
            this.emptyWidgets[index].data.text = text
        },
        setFileInEmptyWidgetData(index, fileIndex, file){
            this.emptyWidgets[index].data.files[fileIndex] = file
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
