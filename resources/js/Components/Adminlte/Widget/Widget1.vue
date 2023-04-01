<template>
    <div class="widget1">
        <h3>{{this.title}}</h3>
        <input class="widget1" type="file" @change="addFile">
    </div>
</template>

<script>
export default {
    name: 'Widget1',
    props: ['index', 'title'],
    data: () => {
        return {
            // files: null,
        }
    },
    methods: {
        getFileUrl(file) {
            if (typeof window !== 'undefined') {
                return URL.createObjectURL(file)
            }
            return ''
        },
        addFile(evt) {
            const file = evt.target.files[0];
        },
    },
};

</script>
<style lang="scss" scoped>
.widget1__container{
    max-height: 200px;
    max-width: 200px;
    &-img{
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
}
</style>
