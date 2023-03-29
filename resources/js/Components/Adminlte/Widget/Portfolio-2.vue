<template>
    <div class="widget-container">
        <form action="">
            <div class="form-group">
                <input type="text" value="" class="form-group-title" placeholder="Введите заголовок">
            </div>
            <div class="form-group">
                <custom-dropzone></custom-dropzone>
                <custom-dropzone></custom-dropzone>
            </div>
        </form>
    </div>
</template>

<script>
import CustomDropzone from "../CustomDropzone.vue";
export default {
    name: "Portfolio2",
    components: {
        CustomDropzone
    }
}
</script>

<style scoped>
.form-group{
    display: flex;
}
.form-group-title{
    width: 100%;
}
</style>
