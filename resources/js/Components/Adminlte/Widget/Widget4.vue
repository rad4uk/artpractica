<template>
    <div class="widget4 widgets">
        <h3>{{ this.title }}</h3>
        <input type="text" v-model="inputValue" placeholder="Введите текст">
    </div>
</template>

<script>
import {adminProjectStore} from "@/store/adminlte/projectStore";
export default {
    name: "Widget4",
    props: ['title', 'index', 'is_type'],
    data: () => {
        return {
            inputValue: ''
        }
    },
    setup() {
        const projectStore = adminProjectStore()
        return {projectStore};
    },
    mounted() {
        if(this.is_type === 'section1'){
            let widgetData = this.getDataInStore()

            this.inputValue = widgetData.title
        }
    },
    methods: {
        getDataInStore(){
            const widget =  this.projectStore.getEmptyWidgetByIndex(this.index);
            return widget.data;
        },
    },
    watch: {
        inputValue(newValue){
            this.projectStore.setTitleInEmptyWidgetData(this.index, newValue)
        }
    },

}
</script>

<style lang="scss" scoped>
.widget4{
    display: flex;
    flex-direction: column;
    gap: 10px;
    padding: 10px;
}
</style>
