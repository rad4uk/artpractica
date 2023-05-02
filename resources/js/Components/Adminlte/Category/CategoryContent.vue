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
                        :action="this.action"
                        :category='this.category'
                        :categories='this.categories'
                        :pages='this.pages'
                        :is_type_page='this.is_type_page'
                    ></form-component>

                </div>

            </div>
            <meta-component
                :meta_title="this.meta_title"
                :meta_description="this.meta_description"
                :is_type_page="this.is_type_page"
                @setMetaTitle="handleMetaTitle"
                @setMetaDescription="handleMetaDescription"
            ></meta-component>
        </div>
    </section>
</template>

<script>
import FormComponent from "./FormComponent.vue";
import MetaComponent from "../MetaComponent.vue";
import {adminCategoryStore} from "@/store/adminlte/categoryStore";

export default {
    name: "CategoryContent",
    data: () => {
        return {
            meta_title: '',
            meta_description: ''
        }
    },
    props: [
        'action',
        'category',
        'categories',
        'pages',
        'is_type_page'
    ],
    setup() {
        const categoryStore = adminCategoryStore()

        return {categoryStore}
    },
    beforeMount() {
      if (this.is_type_page === 'edit' && this.category){
          this.meta_title = this.category.meta_title
          this.meta_description = this.category.meta_description
      }
    },
    components: {
        FormComponent,
        MetaComponent
    },
    methods: {
        handleMetaTitle(value) {
            this.categoryStore.setMetaDataTitle(value)
        },
        handleMetaDescription(value) {
            this.categoryStore.setMetaDataDescription(value)
        }
    }
}
</script>

<style scoped>

</style>
