<template>
    <div class="tab-pane fade active show card-body" id="custom-tabs-three-home" role="tabpanel"
         aria-labelledby="custom-tabs-three-home-tab">

        <div class="card card-blue card-outline collapsed-card">
            <div class="card-header">
                <h3 class="card-title">CОЗДАЁМ И ВОПЛОЩАЕМ</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body" style="display: none;">
                <div class="form-group collection-wrapper">
                    <div class="secondSectionDescription" id="secondSectionDescription">
                        <div class="row collection-row">
                            <div class="form-container">
                                <div class="form-group create-implement-title">
                                    <label for="inputName">Заголовок</label>
                                    <input type="text" id="inputName" v-model="title" class="form-control">
                                </div>
                            </div>
                            <div class="form-container">
                                <div class="form-group textarea-group">
                                    <label for="inputName">Текст</label>
                                    <textarea class="form-control" v-model="firstText" rows="3" placeholder=""
                                              data-dl-input-translation="true"></textarea>
                                </div>
                                <div class="form-group textarea-group">
                                    <label for="inputName">Текст</label>
                                    <textarea class="form-control" v-model="secondText" rows="3" placeholder=""
                                              data-dl-input-translation="true"></textarea>
                                </div>
                            </div>
                            <div class="form-container">
                                <div class="form-group input-group">
                                    <label for="inputName">Количество лет работы студии</label>
                                    <input type="number" id="inputName" v-model="yearQuantity" class="form-control">
                                </div>
                                <div class="form-group input-group">
                                    <label for="inputName">Количество городов</label>
                                    <input type="number" id="inputName" v-model="cityQuantity" class="form-control">
                                </div>
                                <div class="form-group input-group">
                                    <label for="inputName">Реализованных проектов</label>
                                    <input type="number" id="inputName" v-model="projectQuantity" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import {adminHomePageStore} from "@/store/adminlte/homePageStore";
export default {
    name: "FirstFormPartial",
    props: ['is_type_page', 'data'],
    mounted() {
        if (this.is_type_page === 'edit'){
            const data = JSON.parse(this.data)
            if (data !== null){
                this.title = data.title
                this.firstText = data.firstText
                this.secondText = data.secondText
                this.yearQuantity = data.yearQuantity
                this.cityQuantity = data.cityQuantity
                this.projectQuantity = data.projectQuantity
            }
        }
    },
    data: () => {
        return {
            title: '',
            firstText: '',
            secondText: '',
            yearQuantity: '',
            cityQuantity: '',
            projectQuantity: ''
        }
    },
    setup() {
        const homePageStore = adminHomePageStore()

        return {homePageStore}
    },
    watch: {
        title(newValue){
            this.homePageStore.setFirstSectionProperty('title', newValue)
        },
        firstText(newValue){
            this.homePageStore.setFirstSectionProperty('firstText', newValue)
        },
        secondText(newValue){
            this.homePageStore.setFirstSectionProperty('secondText', newValue)
        },
        yearQuantity(newValue){
            this.homePageStore.setFirstSectionProperty('yearQuantity', newValue)
        },
        cityQuantity(newValue){
            this.homePageStore.setFirstSectionProperty('cityQuantity', newValue)
        },
        projectQuantity(newValue){
            this.homePageStore.setFirstSectionProperty('projectQuantity', newValue)
        }
    }

}
</script>

<style lang="scss" scoped>
.form-container{
    display: flex;
    flex-direction: row;
    flex: 0 1 100%;
    gap: 20px;
    .textarea-group{
        flex: 0 1 50%;
    }
    .input-group{
        flex: 0 1 33.333%;
        display: flex;
        flex-direction: column;
        input{
            width: 100%;
        }
    }
    .create-implement-title{
        width: 100%;
    }
}
</style>
