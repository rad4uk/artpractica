<template>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Основное</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <form-component
                        :action='this.action'
                        :is_type_page='this.is_type_page'
                        :categories='this.categories'
                        :template_data='this.template_data'
                        :service='this.service'
                        :file_dir='this.file_dir'
                        :pages='this.pages'
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
import FormComponent from "@/Components/Adminlte/Service/FormComponent.vue";
import MetaComponent from "@/Components/Adminlte/MetaComponent.vue";
import {adminServicesStore} from "@/store/adminlte/servicesStore";
export default {
    name: "ServiceContent",
    components: {
        FormComponent,
        MetaComponent
    },
    data: () => {
      return {
          meta_title: '',
          meta_description: '',
      }
    },
    props: [
        'action',
        'categories',
        'is_type_page',
        'template_data',
        'service',
        'file_dir',
        'pages'
    ],
    beforeMount() {
        if (this.is_type_page === 'edit'){
            this.meta_title = this.service.meta_title
            this.meta_description = this.service.meta_description
        }
    },
    setup() {
        const servicesStore = adminServicesStore()

        return {servicesStore}
    },
    methods: {
        handleMetaTitle(value) {
            this.servicesStore.setMetaDataTitle(value)
        },
        handleMetaDescription(value){
            this.servicesStore.setMetaDataDescription(value)
        }
    }
}
</script>

<style scoped>

</style>
