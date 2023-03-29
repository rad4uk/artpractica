<template>
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Виджеты</h3>
            </div>
            <div class="card-body p-0" style="min-height: 200px">
                <draggable class="dragArea list-group w-full"
                           :list="this.items"
                >
                    <div
                        class="list-group-item bg-gray-300 m-1 p-3 rounded-md text-center"
                        v-for="(item, key) in this.items"
                        :key="key"
                        @drop="onDrop($event)"
                        @dragstart="this.onDragCardStart($event)"
                        @dragover.prevent
                        @dragenter.prevent
                    >
                        <component :is="item.component"></component>
                    </div>
                </draggable>
                <button class="btn btn-primary w-100" @click="this.save()">Save</button>
            </div>
        </div>
        <div class="card card-green">
            <div class="card-header">
                <h3 class="card-title">Виджеты</h3>
            </div>
            <div class="card-body p-0">
                <div v-for="widget in this.widgets"
                     :key="widget.id"
                     @dragstart="this.onDragStart($event, widget)"
                     class="draggable"
                     draggable="true"
                >
                    <component :is="widget.component"
                               class="list-group-item bg-gray-300 m-1 p-3 rounded-md text-center">
                    </component>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import {ref, markRaw} from 'vue';
import Portfolio1 from "./Portfolio-1.vue";
import Portfolio2 from "./Portfolio-2.vue";
import {VueDraggableNext} from 'vue-draggable-next'

export default {
    name: "Portfolio",
    components: {
        draggable: VueDraggableNext,
        Portfolio1: markRaw(Portfolio1),
        Portfolio2: markRaw(Portfolio2)
    },
    data(){
        return {
            enabled: true,
            dragging: false,
            isOnDragCardStart: false,
            tmpWidget: null,
            items: [
                {
                    id: 1,
                    name: 'portfolio-1',
                    widgetId: 1,
                    component: Portfolio1
                },
            ]
        }
    },
    setup() {
        const widgets = ref([
            {
                id: 1,
                name: 'portfolio-1',
                widgetId: 1,
                component: Portfolio1
            },
            {
                id: 2,
                name: 'portfolio-2',
                widgetId: 2,
                component: Portfolio2
            }
        ]);
        return {widgets}
    },
    methods: {
        save() {
            const title = this.getTitle(this.items[0].component);
            console.log(this.items[0].component)
            // this.items.forEach(item => {
            //     console.log(item.component)
            // })
        },
        getTitle(component) {
            const instance = this.$options.components[component.name];
            console.log(instance)
            return instance.methods.getTitle();
        },
        onDragStart(e, item) {
            e.dataTransfer.dropEffect = 'move'
            e.dataTransfer.effectAllowed = 'move'
            this.tmpWidget = item
            this.isOnDragCardStart = true
        },
        onDrop(e) {
            if (this.isOnDragCardStart && this.tmpWidget !== null) {
                this.items.push(this.tmpWidget)
            }
            this.tmpWidget = null;
            this.isOnDragCardStart = false
        },
        onDragCardStart(e) {
            e.dataTransfer.dropEffect = 'move'
            e.dataTransfer.effectAllowed = 'move'
            this.isOnDragCardStart = true
        }


    }
};
</script>

<style scoped>

</style>
