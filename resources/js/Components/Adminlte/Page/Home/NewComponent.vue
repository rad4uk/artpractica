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

                    <form-component></form-component>

                    <!-- /.card-body -->
                </div>
            </div>
        </div>

    </section>
</template>

<script>
import FormComponent from './FormComponent.vue'
export default {
    name: "New",
    components: {
        FormComponent
    }
}
</script>

<style scoped>

</style>
