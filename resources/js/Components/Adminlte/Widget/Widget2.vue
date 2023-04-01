<template>
    <div>
        <h3>Виджет 2</h3>
        <input type="file" @change="addFile(0)">
        <input type="file" @change="addFile(1)">
<!--        <ul>-->
<!--            <li v-for="(file, index) in value" :key="index">-->
<!--                {{ file.name }} <button @click="removeFile(index)">Удалить</button>-->
<!--            </li>-->
<!--        </ul>-->
    </div>
</template>

<script>
export default {
    name: 'Widget2',
    props: {
        value: {
            type: Array,
            default: () => [],
        },
    },
    methods: {
        addFile(index, evt) {
            const file = evt.target.files[0];
            const files = [...this.value];
            files[index] = file;
            this.$emit('input', files);
        },
        removeFile(index) {
            const files = [...this.value];
            files.splice(index, 1);
            this.$emit('input', files);
        },
    },
};
</script>
