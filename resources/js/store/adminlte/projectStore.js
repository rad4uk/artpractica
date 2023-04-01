import { defineStore } from 'pinia'
import Widget1 from "../../Components/Adminlte/Widget/Widget1.vue";
import Widget2 from "../../Components/Adminlte/Widget/Widget2.vue";
import Widget3 from "../../Components/Adminlte/Widget/Widget3.vue";
export const adminProjectStore = defineStore('projectStore', {
    state: () => ({
        dragItem: null,
        dragItemIndex: null,
        emptyWidgets: [],
        widgets: [
            {
                id: 1,
                component: Widget1,
                title: 'Загрузить одно фото',
            },
            {
                id: 2,
                component: Widget2,
                title: 'Загрузить два фото',
            },
            {
                id: 3,
                component: Widget3,
                title: 'Заголовок к секции',
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
    },
    actions: {
        setToEmptyWidget(widget){
            this.emptyWidgets.push(widget)
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
        onDrop(widgetId){
            this.widgets.filter(item => {
                if (item.id === widgetId) {
                    this.emptyWidgets.push(item)
                }
            })
        }

    }
})
