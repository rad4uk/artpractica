<template>
    <div class="tab-pane fade active show card-body" id="custom-tabs-three-home" role="tabpanel"
         aria-labelledby="custom-tabs-three-home-tab">
        <div class="card card-blue card-outline collapsed-card">
            <div class="card-header">
                <h3 class="card-title">Работая с нами вы получаете</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body" style="display: none;">
                <div class="form-group collection-wrapper">
                    <div class="secondSectionDescription" id="secondSectionDescription">
                        <div class="form-container">
                            <div class="row collection-row">
                                <div class="form-group form-title-container">
                                    <label for="inputName">Заголовок</label>
                                    <input type="text" id="inputName" class="form-control">
                                </div>
                            </div>
                        </div>
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
    </div>

</template>

<script>
export default {
    name: "SecondFormPartial",
    data: () => {
        return {
            itemIndex: null,
            items: []
        }
    },
    methods: {
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
    }
}
</script>

<style lang="scss" scoped>
.form-title-container{
    width: 100%;
}
</style>
