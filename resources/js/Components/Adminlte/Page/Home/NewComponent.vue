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
                        :dir_path="this.dir_path"
                        :is_type_page="this.is_type_page"
                    ></form-component>

                    <!-- /.card-body -->
                </div>
            </div>
            <meta-component
                @setMetaTitle="handleMetaTitle"
                @setMetaDescription="handleMetaDescription"
                :meta_title="this.page.meta_title"
                :meta_description="this.page.meta_description"
                :is_type_page="this.is_type_page"
            ></meta-component>
        </div>

    </section>
</template>

<script>
import FormComponent from './FormComponent.vue'
import MetaComponent from "./MetaComponent.vue";

import {adminHomePageStore} from "@/store/adminlte/homePageStore";
export default {
    name: "New",
    props: [
        'action',
        'is_type_page',
        'page',
        'dir_path'
    ],
    components: {
        FormComponent,
        MetaComponent
    },
    setup() {
        const homePageStore = adminHomePageStore()

        return {homePageStore}
    },
    methods: {
        handleMetaTitle(value) {
            this.homePageStore.setMetaDataTitle(value)
        },
        handleMetaDescription(value){
            this.homePageStore.setMetaDataDescription(value)
        }
    }

}
</script>

<style scoped>

</style>
