<template>

        <optgroup :label="category.title">
            <option>
                {{ category.title }}
            </option>
            <OptionComponent
                v-if="category.children_recursive.length > 0"
                v-for="(child, key) in category.children_recursive"
                :category="child"
                :key="key + child.title"
            >
            </OptionComponent>

        </optgroup>

</template>

<script>
export default {
    name: "OptionComponent",
    props: ['category'],
    mounted() {
        console.log(this.category.children_recursive.length)
    }
}
</script>

<style scoped>

</style>
