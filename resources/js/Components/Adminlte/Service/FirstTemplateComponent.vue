<template>
    <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel"
         aria-labelledby="custom-tabs-three-home-tab">
        <form action="">
            <div class="form-group">
                <label for="inputName">Загаловок к первой секции</label>
                <input type="text" id="inputName" name="subtitle" class="form-control" v-model="titleValue">
            </div>

            <div class="card card-blue card-outline collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">ЭТАПЫ РАБОТЫ</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body" style="display: none;">
                    <div class="form-group collection-wrapper">
                        <div class="secondSectionDescription" id="secondSectionDescription">
                            <div class="row collection-row"
                                 style="border-bottom: 1px solid #007bff; margin-bottom: 10px"
                                 v-for="(item, index) in items" :key="index"
                            >
                                <div class="form-group col-11">
                                    <div class="form-group">
                                        <label>Заголовок</label>
                                        <input type="text" class="form-control" v-model="item.input" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label>Описание</label>
                                        <textarea class="form-control" rows="3" v-model="item.textarea" placeholder=""
                                                  data-dl-input-translation="true"></textarea>
                                    </div>
                                </div>

                                <div class="form-group col-1 col-sm-1 table-trash"
                                     @click="this.removeInputAndTextarea(index)"
                                     style="display: flex; align-items: center">
                                    <a class="btn btn-danger btn-sm remove-collection-item"><i
                                        class="fas fa-trash-alt"></i></a>
                                </div>
                            </div>

                        </div>

                    </div>
                    <button type="button" class="btn btn-info add_item_link"
                            data-collection-holder-class="secondSectionDescription"
                            @click.prevent="addInputAndTextarea"
                    >
                        Добавить запись
                    </button>
                </div>

            </div>
            <div class="form-group form-check-inline">
                <label class="form-check-label">
                    <input type="checkbox" name="status" class="form-check-input" v-model="on" @change="this.setTemplate(this.on)">Выбрать текущий шаблон
                </label>
            </div>
        </form>
    </div>
</template>

<script>
import {adminServicesStore} from "@/store/adminlte/servicesStore";
import { watch } from 'vue';

export default {
    name: "FirstTemplateComponent",
    data() {
        return {
            itemIndex: null,
            on: false,
            titleValue: '',
            items: [],
        };
    },
    setup() {
        const servicesStore = adminServicesStore()

        return {servicesStore}
    },
    mounted() {
        const currentTemplate = this.servicesStore.getCurrentTemplate
        if (currentTemplate !== null && currentTemplate.name === 'firstTemplate'){
            this.on = true
        }
    },
    created() {
        watch(() => this.items, (newValue, oldValue) => {
            console.log('items have changed:', newValue);
        });
    },
    methods: {
        setTemplate(isActive){
            if (isActive){
                const template = this.servicesStore.getFirstTemplate
                this.servicesStore.setCurrentTemplate(template)
            }else{
                this.servicesStore.setCurrentTemplate(null)
            }
        },
        addInputAndTextarea() {
            this.items.push({input: "", textarea: ""});
            if (this.itemIndex !== null || this.items.length > 0){
                this.itemIndex++
            }
        },
        removeInputAndTextarea(index) {
            this.items.splice(index, 1);
            if (this.itemIndex !== null && this.items.length > 0){
                this.itemIndex--
            }else{
                this.itemIndex = null
            }
        }
    },
    watch: {
        titleValue(value){
            this.servicesStore.setFirstTemplateFirstSectionTitle(value)
        },
        itemIndex(value){
            if (value !== null){
                this.servicesStore.setFirstTemplateFirstSectionDescription(this.items)
            }else{
                this.servicesStore.setFirstTemplateFirstSectionDescription([])
            }
        }
    },
}
</script>

<style scoped>

</style>
