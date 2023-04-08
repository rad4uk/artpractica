<template>
    <div class="widget3 widgets">
        <h3>{{ this.title }}</h3>
        <input type="text" v-model="inputValue" placeholder="Введите текст">
    </div>
</template>

<script>
import {adminProjectStore} from "@/store/adminlte/projectStore";
export default {
    name: "Widget3",
    props: ['title', 'index'],
    data: () => {
        return {
            inputValue: ''
        }
    },
    setup() {
        const projectStore = adminProjectStore()
        return {projectStore};
    },
    methods: {
        formingData(titleText){
            return [
                {
                    title: titleText
                }
            ]
        }
    },
    watch: {
        inputValue(newValue){
            this.projectStore.setEmptyWidgetData(this.index, this.formingData(newValue))
        }
    },

}
</script>

<style lang="scss" scoped>
.widget3{
    display: flex;
    flex-direction: column;
    gap: 10px;
    padding: 10px;
}
</style>
