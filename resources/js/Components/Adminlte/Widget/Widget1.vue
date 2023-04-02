<template>
    <div class="widget1">
        <h3>{{ this.title }}</h3>
        <input class="widget1" type="file" @change="addFile">
        <div>

        </div>
    </div>
</template>

<script>
import {adminProjectStore} from "@/store/adminlte/projectStore";

export default {
    name: 'Widget1',
    props: ['index', 'title'],
    data: () => {
        return {}
    },
    setup() {
        const projectStore = adminProjectStore()
        return {projectStore};
    },
    mounted() {

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
            this.projectStore.setEmptyWidgetData(this.index, file)
        },
    },
};

</script>
<style lang="scss" scoped>
.widget1__container {
    max-height: 200px;
    max-width: 200px;

    &-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
}
</style>
