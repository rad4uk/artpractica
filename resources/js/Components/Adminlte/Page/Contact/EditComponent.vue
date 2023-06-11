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

                    <form-component
                        :action="this.action"
                        :page="this.page"
                        :is_type_page="this.is_type_page"
                    ></form-component>

                </div>
            </div>
            <meta-component
                @setMetaTitle="handleMetaTitle"
                @setMetaDescription="handleMetaDescription"
                :meta_title="this.meta_title"
                :meta_description="this.meta_description"
                :is_type_page="this.is_type_page"
            ></meta-component>
        </div>

    </section>
</template>

<script>
import {adminMetaDataStore} from "@/store/adminlte/metaDataStore";
import MetaComponent from "@/Components/Adminlte/MetaComponent.vue";
import FormComponent from "@/Components/Adminlte/Page/Contact/FormComponent.vue";

export default {
    name: "EditComponent",
    props: ['page', 'is_type_page', 'action'],
    data: () => {
        return {
            meta_title: '',
            meta_description: '',
        }
    },
    components: {
        MetaComponent,
        FormComponent
    },
    beforeMount() {
        if (this.is_type_page === 'edit'){
            this.meta_title = this.page.meta_title
            this.meta_description = this.page.meta_description
        }
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
