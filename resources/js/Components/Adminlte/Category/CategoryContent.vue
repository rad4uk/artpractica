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
                    <form-component
                        :action="this.action"
                        :category='this.category'
                        :categories='this.categories'
                        :pages='this.pages'
                        :is_type_page='this.is_type_page'
                    ></form-component>

                </div>

            </div>
            <meta-component
                :meta_title="this.meta_title"
                :meta_description="this.meta_description"
                :is_type_page="this.is_type_page"
                @setMetaTitle="handleMetaTitle"
                @setMetaDescription="handleMetaDescription"
            ></meta-component>
        </div>
        <div class="row"
            v-if="this.category.id !== 1"
        >
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Проекты</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <draggable class="dragArea"
                               :list="this.list"
                               @change="this.sortUpdate"
                    >
                        <ul class="dragArea__list"
                            v-for="post in this.list"
                            :key="post.id"
                        >
                            <li>
                                {{ post.title }}
                            </li>

                        </ul>
                    </draggable>
                </div>
            </div>
        </div>
    </section>
    <spinner :class="{'active': this.spinnerActive}"></spinner>
</template>

<script>
import FormComponent from "./FormComponent.vue";
import MetaComponent from "../MetaComponent.vue";
import {adminCategoryStore} from "@/store/adminlte/categoryStore";
import {VueDraggableNext} from 'vue-draggable-next'
import axios from "axios";
import Spinner from "@/Components/Adminlte/Spinner.vue";

export default {
    name: "CategoryContent",
    data: () => {
        return {
            list: [],
            meta_title: '',
            meta_description: '',
            spinnerActive: false
        }
    },
    props: [
        'action',
        'category',
        'posts',
        'categories',
        'pages',
        'is_type_page'
    ],
    setup() {
        const categoryStore = adminCategoryStore()

        return {categoryStore}
    },
    mounted() {
        if (this.is_type_page === 'edit' && this.category) {
            this.list = this.posts
            this.meta_title = this.category.meta_title
            this.meta_description = this.category.meta_description
        }
    },
    components: {
        draggable: VueDraggableNext,
        FormComponent,
        MetaComponent,
        Spinner
    },
    methods: {
        handleMetaTitle(value) {
            this.categoryStore.setMetaDataTitle(value)
        },
        handleMetaDescription(value) {
            this.categoryStore.setMetaDataDescription(value)
        },
        async sortUpdate(event) {
            this.spinnerActive = true
            let data = this.list.map(function (post, index) {
                return {
                    "id": post.id,
                    "category_sort": index
                }
            })
            await axios.put('/admin/post/category-sort/update', data)
                .then(response => {
                    console.log(response)
                })
                .catch(error => {
                    console.log(error)
                })
                .finally(() => {
                    this.spinnerActive = false
                })
        },
    }
}
</script>

<style lang="scss" scoped>
.dragArea {
    display: flex;
    flex-direction: column;


    &__list {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        padding: 0;
        margin: 0;

        li {
            padding: 0.75em;
            flex: 0 1 25%;
            list-style: none;
        }

    }

    &__list.header {
        justify-content: start;
        border-bottom: 2px solid #dee2e6;

        li {
            font-weight: bold;
        }
    }

    ul:hover {
        cursor: pointer;
    }

    ul:nth-of-type(odd) {
        background-color: rgba(0, 0, 0, .05);
    }
}
</style>
