<template>
    <div class="widget-container">
        <div class="section1">
            <h1>Section 1</h1>
            <div class="drop-zone"
                 @drop="onDrop"
                 @dragover.prevent
                 @dragenter.prevent
            >
                <div class="item"
                     v-for="(widget, index) in this.getEmptyWidgets()"
                     draggable="true"
                     @dragstart="dragItemStart($event, index)"
                     @drop="dropItem($event, index)"
                     @dragover.prevent
                >
                    <component :is="widget.component"
                               :title="widget.title"
                               :index="index"
                    ></component>
                    <button class="btn btn-danger" @click="removeToEmptyWidget(index)">-</button>
                </div>

            </div>
            <button class="btn btn-success" @click="this.save()">save</button>
        </div>

        <div class="section2">
            <h1>Section 2</h1>

            <div
                class="draggable"
                draggable="true"
                @dragstart="onDragStart($event, widget)"
                v-for="(widget, index) in this.getWidgets()"
            >
                <component :is="widget.component"
                           :title="widget.title"
                           :index="index"
                ></component>
                <button class="btn btn-success" @click="addToEmptyWidget(widget)">+</button>
            </div>
        </div>

    </div>
</template>

<script>

import {adminProjectStore} from "@/store/adminlte/projectStore";
export default {
    name: 'WidgetContainer',
    setup() {
        const projectStore = adminProjectStore()

        return {projectStore}
    },
    data: () => {
      return {

      }
    },
    methods: {
        save(){
            this.projectStore.getEmptyWidgets.forEach(item => {
                console.log(item)
            })
        },
        getEmptyWidgets(){
            return this.projectStore.getEmptyWidgets
        },
        getWidgets(){
            return this.projectStore.getWidgets
        },
        addToEmptyWidget(widget) {
            this.projectStore.setToEmptyWidget(widget)
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
                if(item.id === widgetId){
                    this.projectStore.onDrop(item)
                }
            })
        },
        dragItemStart(event, index) {
            event.dataTransfer.effectAllowed = 'move';
            this.projectStore.dragItemStart(index)
        },
        dropItem(event, index) {
            event.preventDefault();
            this.projectStore.dropItem(index)
        },
    }

}
</script>
<style>
.widget-container {
    width: 50%;
    /*height: 600px;*/
    border: 1px solid darkgreen;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.widget-container .section1, .section2 {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid darkgreen;
    background: #0c84ff;
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
    flex: 0 1 90%;
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

.draggable div {
    background: #ffffff;
    flex: 0 1 90%;
}

.draggable .btn {
    flex: 0 1 10%;
}
</style>
