<template>
    <div class="widget-container">
        <div class="section1">
            <h2>Перетащите или добавьте виджеты</h2>
            <div class="drop-zone"
                 @drop="onDrop"
                 @dragover.prevent
                 @dragenter.prevent
            >
                <div class="item"
                     v-for="(widget, index) in this.getEmptyWidgets"
                     draggable="true"
                     @dragstart="dragItemStart($event, index)"
                     @drop="dropItem($event, index)"
                     @dragover.prevent
                     :key="widget.id"
                >
                    <component :is="widget.name"
                               :title="widget.widgetTitle"
                               :name="widget.name"
                               :index="index"
                               :is_type="'section1'"
                    ></component>
                    <button class="btn btn-danger" @click="removeToEmptyWidget(index)">-</button>
                </div>

            </div>
            <!--            <button class="btn btn-success" @click="this.save()">save</button>-->
        </div>

        <div class="section2">
            <h2>Виджеты</h2>

            <div
                class="draggable"
                draggable="true"
                @dragstart="onDragStart($event, widget)"
                v-for="(widget, index) in this.getWidgets"
            >
                <component :is="widget.name"
                           :title="widget.widgetTitle"
                           :name="widget.name"
                           :index="index"
                           :is_type="'section2'"
                ></component>
                <button class="btn btn-success" @click="addToEmptyWidget(widget)">+</button>
            </div>
        </div>

    </div>
</template>

<script>

import {adminProjectStore} from "@/store/adminlte/projectStore";
import Widget1 from "@/Components/Adminlte/Widget/Widget1.vue";
import Widget2 from "@/Components/Adminlte/Widget/Widget2.vue";
import Widget3 from "@/Components/Adminlte/Widget/Widget3.vue";
import Widget4 from "@/Components/Adminlte/Widget/Widget4.vue";
import Widget5 from "@/Components/Adminlte/Widget/Widget5.vue";

import _ from 'lodash';

export default {
    name: 'WidgetContainer',
    props: ['type_admin_page', 'widgets', 'file_dir'],
    data: () => {
        return {
            counter: 0
        }
    },
    components: {
        Widget1,
        Widget2,
        Widget3,
        Widget4,
        Widget5
    },
    beforeMount() {
        if (this.type_admin_page === 'edit') {
            this.addWidgetInEmptyData(this.widgets)
        }
    },
    mounted() {

    },
    setup() {
        const projectStore = adminProjectStore()

        return {projectStore}
    },
    methods: {
        generateId() {
            return ++this.counter
        },
        async addWidgetInEmptyData(widgets) {
            await Promise.all(widgets.map(async (widget) => {
                if (widget.data.files) {
                    await Promise.all(widget.data.files.map(async (fileName, index) => {
                        widget.data.files[index] = await this.fetchFile(this.file_dir, fileName)
                    }))
                }
            }))
            widgets.map( widget => {
                this.projectStore.setToEmptyWidget(widget)
            })
        },
        async fetchFile(dirPath, fileName) {
            return await fetch(dirPath + '/' + fileName)
                .then(response => response.blob())
                .then(blob => {
                    return new File([blob], fileName, {type: blob.type})
                })
        },
        async save() {
            let formData = new FormData()

            const emptyWidgets = this.projectStore.getEmptyWidgets;
            for (let i = 0; i < emptyWidgets.length; i++) {

                const widgetName = emptyWidgets[i].name;
                const widgetData = emptyWidgets[i].data;

                const keys = Object.keys(widgetData);
                for (const key of keys) {
                    const value = widgetData[key];

                    if (Array.isArray(value)) {
                        for (const file of value) {
                            formData.append(`${i}_${widgetName}[${key}][]`, file);
                        }
                    } else {
                        formData.append(`${i}_${widgetName}[${key}]`, value);
                    }
                }

            }
            try {
                const response = await axios.post('/api/project/new', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                console.log(response.data)
            } catch (error) {
                console.error(error)
            }

            this.projectStore.getEmptyWidgets.forEach(item => {
                console.log(item)
            })
        },

        addToEmptyWidget(widget) {
            const newWidget = _.cloneDeep(widget)
            this.projectStore.setToEmptyWidget(newWidget)
        },
        removeToEmptyWidget(index) {
            this.projectStore.removeToEmptyWidget(index)
        },
        onDragStart(event, widget) {
            event.dataTransfer.dropEffect = 'move'
            event.dataTransfer.effectAllowed = 'move'
            event.dataTransfer.setData("text/plain", widget.id.toString());
        },
        onDrop(event) {
            const widgetId = parseInt(event.dataTransfer.getData("text/plain"));
            this.projectStore.getWidgets.filter(item => {
                if (item.id === widgetId) {
                    let newWidget = _.cloneDeep(item)
                    this.projectStore.onDrop(newWidget)
                }
            })
        },
        dragItemStart(event, index) {
            // console.log('drag start index - ' + index)
            event.dataTransfer.effectAllowed = 'move';
            this.projectStore.dragItemStart(index)
        },
        dropItem(event, index) {
            event.preventDefault();
            this.projectStore.dropItem(index)
        },
    },
    computed: {
        getEmptyWidgets: function () {
            return this.projectStore.getEmptyWidgets.map(widget => {
                return {
                    ...widget,
                    id: this.generateId()
                }
            })
        },
        getWidgets: function () {
            return this.projectStore.getWidgets;
        },
    }

}
</script>
<style>
.widgets {
    flex: 0 1 90%;
}

.widget-container {
    width: 50%;
    /*height: 600px;*/
    /*border: 1px solid darkgreen;*/
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.widget-container .section1, .section2 {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px dashed #28a745;
    /*background: #0c84ff;*/
}

.drop-zone {
    min-height: 150px;
    padding-bottom: 50px;
}

.drop-zone .item {
    display: flex;
    gap: 20px;
    margin-bottom: 10px;
}

.drop-zone .item div {
    background: #ffffff;
}

.drop-zone .item .btn {
    flex: 0 1 10%;
}

.draggable {
    margin-bottom: 10px;
    display: flex;
    gap: 20px;
}

.draggable .widgets {
    background: #ffffff;
    flex: 0 1 90%;
}

.draggable .btn {
    flex: 0 1 10%;
}
</style>
