<template>
    <table class="table table-striped projects">
        <thead>
        <tr>
            <th style="width: 1%">
                #
            </th>
            <th style="width: 20%">
                Заголовок
            </th>
            <th style="width: 20%">
                Родительская категория
            </th>
            <th style="width: 30%">
                Описание
            </th>

            <th style="width: 8%" class="text-center">
                Ссылка
            </th>
            <th style="width: 20%">
            </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="category in this.getContentFromCategoryStorage()">
            <td>
                #
            </td>
            <td>
                {{ category.title }}
            </td>
            <td>
                {{ (category.parent !== null)? category.parent.title : 'Нет'}}
            </td>
            <td>
                {{ category.description }}
            </td>

            <td>
                <a :href="category.slug">{{ category.slug }}</a>
            </td>
            <td class="project-actions text-right">
                <a class="btn btn-primary btn-sm" href="#">
                    <i class="fas fa-folder">
                    </i>
                    View
                </a>
                <a class="btn btn-info btn-sm" :href="'/admin/categories/' + category.id + '/edit'">
                    <i class="fas fa-pencil-alt">
                    </i>
                    Изменить
                </a>
                <DeleteItem :item="category" :route="this.deleteRoute"></DeleteItem>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>
import {adminCategoryStore} from "@/store/categoryStore";
import DeleteItem from "@/Components/Adminlte/DeleteItem.vue";
export default {
    name: "CategoryIndexContent",
    components: {
      DeleteItem
    },
    data: () => {
        return {
            deleteRoute: '/api/category/delete',
            categories: []
        }
    },
    setup() {
        const categoryContentStore = adminCategoryStore()

        return {categoryContentStore}
    },
    mounted() {
        this.fetchCategoryContent()
    },
    methods: {
        async fetchCategoryContent() {
            await axios.get('/api/category/fetch')
                .then(res => {
                    if (res.status === 200) {
                        this.categoryContentStore.setCategories(res.data)
                    }
                })
        },
        getContentFromCategoryStorage() {
            return this.categoryContentStore.getCategories
        },

    }
}
</script>

<style scoped>

</style>
