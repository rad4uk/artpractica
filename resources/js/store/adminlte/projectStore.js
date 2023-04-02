import { defineStore } from 'pinia'
import Widget1 from "../../Components/Adminlte/Widget/Widget1.vue";
import Widget2 from "../../Components/Adminlte/Widget/Widget2.vue";
import Widget3 from "../../Components/Adminlte/Widget/Widget3.vue";
import {markRaw} from "vue";
export const adminProjectStore = defineStore('projectStore', {
    state: () => ({
        dragItem: null,
        dragItemIndex: null,
        emptyWidgets: [],
        widgets: [
            {
                id: 1,
                component: markRaw(Widget1),
                title: 'Загрузить одно фото',
            },
            {
                id: 2,
                component: markRaw(Widget2),
                title: 'Загрузить два фото',
            },
            {
                id: 3,
                component: markRaw(Widget3),
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
        getEmptyWidgetByIndex: state => {
            return index => state.emptyWidgets[index]
        }
    },
    actions: {
        setEmptyWidgetData(index, data){
            this.emptyWidgets[index].data = data
        },
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
        onDrop(widget){
            // this.widgets.filter(item => {
            //     if (item.id === widgetId) {
            //         item.store = useAdminProjectStore()
            //         this.emptyWidgets.push(item)
            //     }
            // })
            // widget.store = useAdminProjectStore()
            let newData = {
                'id': widget.id,
                'title': widget.title,
                'component': widget.component,
            }
            this.emptyWidgets.push(newData)
        }

    }
})
