<template>
    <div class="form-row">
        <meta-component
            @setMetaTitle="handleMetaTitle"
            @setMetaDescription="handleMetaDescription"
            :meta_title="this.meta_title"
            :meta_description="this.meta_description"
            :is_type_page="this.type_admin_page"
            :class="'col-md-12'"
            style="flex: 0"
        ></meta-component>
        <div class="col-md-12" style="flex: 0">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Основное</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <CreateFormComponent
                    :action='this.action'
                    :type_admin_page='this.type_admin_page'
                    :post='this.post'
                    :all_additional_posts='this.all_additional_posts'
                    :additional_posts='this.additional_posts'
                    :categories='this.categories'
                    :file_dir='this.file_dir'
                ></CreateFormComponent>
            </div>
        </div>
    </div>

</template>

<script>
import CreateFormComponent from '@/Components/Adminlte/Post/CreateFormComponent.vue'
import MetaComponent from "@/Components/Adminlte/MetaComponent.vue";
import {adminProjectStore} from "@/store/adminlte/projectStore";
export default {
    name: "ProjectContent",
    components: {
        CreateFormComponent,
        MetaComponent
    },
    setup() {
        const projectStore = adminProjectStore()
        return {projectStore}
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
        'type_admin_page',
        'post',
        'file_dir',
        'additional_posts',
        'all_additional_posts',
    ],
    beforeMount() {
        if (this.type_admin_page === 'edit'){
            this.meta_title = this.post.meta_title
            this.meta_description = this.post.meta_description
        }
    },
    methods: {
        handleMetaTitle(value) {
            this.projectStore.setMetaDataTitle(value)
        },
        handleMetaDescription(value){
            this.projectStore.setMetaDataDescription(value)
        }
    }
}
</script>

<style lang="scss" scoped>
.form-row{
    display: flex;
    flex-direction: column;
    width: 50%;
}
</style>
