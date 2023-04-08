<template>
    <option :value="category.id">{{'&nbsp'.repeat(this.repeat_count) + category.title}}</option>
    <OptionComponent
        v-if="this.category.children_recursive.length > 0"
        v-for="(cat, index) in this.category.children_recursive"
        :category="cat"
        :key="index"
        :repeat_count="this.getRepeatCount"
    ></OptionComponent>
</template>

<script>
export default {
    name: "OptionComponent",
    props: ['category', 'repeat_count'],
    computed: {
        getRepeatCount: function () {
            return this.repeat_count + 3;
        }
    }
}
</script>

<style scoped>

</style>
