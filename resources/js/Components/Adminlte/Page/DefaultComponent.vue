<template>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Основное</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <default-form
                        :action="this.action"
                    ></default-form>

                </div>
            </div>
            <meta-component
                @setMetaTitle="handleMetaTitle"
                @setMetaDescription="handleMetaDescription"
            ></meta-component>
        </div>

    </section>
</template>

<script>
import MetaComponent from "@/Components/Adminlte/MetaComponent.vue";
import DefaultForm from "@/Components/Adminlte/Page/DefaultForm.vue";

import {adminMetaDataStore} from "@/store/adminlte/metaDataStore";
export default {
    name: "DefaultComponent",
    props: ['action'],
    components: {
        DefaultForm,
        MetaComponent,
    },
    setup() {
        const metaDataStore = adminMetaDataStore()

        return {metaDataStore}
    },
    methods: {
        handleMetaTitle(value) {
            this.metaDataStore.setMetaDataTitle(value)
        },
        handleMetaDescription(value){
            this.metaDataStore.setMetaDataDescription(value)
        }
    }
}
</script>

<style scoped>

</style>
