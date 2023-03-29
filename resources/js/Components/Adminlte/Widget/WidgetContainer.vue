<template>
    <div class="widget-container">
        <div v-for="(widget, index) in widgets" :key="index"
             draggable="true"
             @dragstart="onDragStart(index)"
             @dragover.prevent="onDragOver(index)"
             @drop="onDrop(index)"
        >
            <component :is="widget.type"
                       :index="index"
                       :text="widget.text"
                       :file="widget.file"
                       :file1="widget.file1"
                       :file2="widget.file2"
                       :onWidgetSort="onWidgetSort"
            ></component>
        </div>
    </div>
</template>

<script>
import { reactive } from 'vue';
import SingleWidget from './SingleWidget.vue';
import DoubleWidget from './DoubleWidget.vue';

export default {
    components: {
        SingleWidget,
        DoubleWidget
    },
    props: {
        widgets: Array,
        onWidgetSort: Function
    },
    setup(props) {
        let draggingWidgetIndex = null;
        let hoverWidgetIndex = null;

        const widgets = reactive([
            { type: 'SingleWidget', text: '', file: null },
            { type: 'DoubleWidget', text: '', file1: null, file2: null }
        ]);

        const onWidgetSort = (fromIndex, toWidget) => {
            widgets.splice(fromIndex, 1);
            widgets.splice(fromIndex > toIndex ? toIndex : toIndex - 1, 0, toWidget);
        };

        const onDragStart = index => {
            draggingWidgetIndex = index;
        };

        const onDragOver = index => {
            hoverWidgetIndex = index;
        };

        const onDrop = index => {
            const toIndex = hoverWidgetIndex > draggingWidgetIndex ? index : index - 1;
            onWidgetSort(draggingWidgetIndex, toIndex);
            draggingWidgetIndex = null;
            hoverWidgetIndex = null;
        };

        return {
            widgets, onWidgetSort, onDragStart, onDragOver, onDrop
        };
    }
};
</script>

<style>
.widget-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.widget-container .single-widget,
.widget-container .double-widget {
    margin: 10px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #fff;
}


</style>
