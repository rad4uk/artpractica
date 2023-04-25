<template>
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Мета данные</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <form @submit.prevent>
                <div class="card-body">
                    <div class="form-group">
                        <label for="inputName">Мета Заголовок</label>
                        <input type="text" id="inputName" name="title" v-model="metaTitle" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="inputDescription">Мета Описание</label>
                        <textarea id="inputDescription" name="description" v-model="metaDescription" class="form-control" rows="4" placeholder="начните вводить текст"></textarea>
                    </div>
                </div>
            </form>
            <!-- /.card-body -->
        </div>
    </div>
</template>

<script>
export default {
    name: "MetaComponent",
    props: ['meta_title', 'meta_description', 'is_type_page'],
    mounted() {
        if (this.is_type_page === 'edit'){
            this.metaTitle = this.meta_title
            this.metaDescription = this.meta_description
        }
    },
    data: () => {
        return {
            metaTitle: '',
            metaDescription: ''
        }
    },
    watch: {
        metaTitle(newValue){
            this.$emit('setMetaTitle', newValue);
        },
        metaDescription(newValue){
            this.$emit('setMetaDescription', newValue);
        }
    }
}
</script>

<style scoped>

</style>
