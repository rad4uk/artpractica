<template>
    <div class="form-group">
        <label for="inputStatus">Категории</label>
        <select id="inputStatus" name='categoryList' class="form-control custom-select">
            <option disabled>Выберите родительскую категорию</option>
            <option
                v-for="(category, key) in categories"
                :key="key"
            >
                {{category.title}}
            </option>


        </select>
    </div>
</template>

<script>
import OptionComponent from "./Option.vue";

export default {
    name: "Select",
    components: {
      OptionComponent
    },
    props: ['categories'],
    // data: function() {
    //     return {
    //         category: '',
    //     }
    // },
    mounted() {
        console.log(1)
    },
    methods: {}
}
</script>

<style scoped>

</style>
