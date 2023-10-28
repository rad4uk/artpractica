<script>
import {VueDraggableNext} from 'vue-draggable-next'
import axios from "axios";
import AlertPopup from "@/Components/Adminlte/Post/AlertPopup.vue";
import Spinner from "@/Components/Adminlte/Spinner.vue";

export default {
    name: "DraggableComponent",
    props: {
        posts: {
            type: Array,
            required: true,
            default: []
        }
    },
    components: {
        draggable: VueDraggableNext,
        AlertPopup,
        Spinner
    },
    mounted() {
        this.list = this.posts
    },
    data() {
        return {
            errorMessage: '',
            isShowAlert: false,
            removePost: null,
            enabled: true,
            list: [],
            dragging: false,
            spinnerIsActive: false
        }
    },
    methods: {
        async sortUpdate(event) {
            this.spinnerIsActive = true
            let data = this.list.map(function (post, index) {
                return {
                    "id": post.id,
                    "sort": index
                }
            })
            await axios.put('/admin/post/sort/update', data)
                .then(response => {
                    console.log(response)
                })
                .catch(error => {
                    console.log(error)
                })
                .finally(() => {
                    this.spinnerIsActive = false
                })
        },
        openRemovePopup(post) {
            this.removePost = post
            this.isShowAlert = true
        },
        handleClosePopup() {
            this.errorMessage = ''
            this.removePost = null
            this.isShowAlert = false
        },

        async handleRemovePost(post) {
            axios.delete('/admin/post/' + post.id + '/delete')
                .then(function (response) {
                    if (response.status === 204) {
                        window.location.href = '/admin/post/';
                    } else {
                        this.errorMessage = response.data
                    }
                })
                .catch((error) => {
                    this.errorMessage = error.message
                });
        }
    },
}
</script>

<template>
    <ul class="dragArea__list header">
        <li>id</li>
        <li>Заголовок</li>
        <li>Родительская категория</li>
    </ul>
    <draggable class="dragArea"
               :list="this.list"
               @change="this.sortUpdate"
    >
        <ul class="dragArea__list"
            v-for="post in this.list"
            :key="post.id"
        >
            <li>
                {{ post.id }}
            </li>
            <li>
                {{ post.title }}
            </li>
            <li>
                {{ post.category.title }}
            </li>

            <li class="project-actions text-right">
                <a class="btn btn-primary btn-sm" target="_blank"
                   :href="'/admin/post/' + post.id + '/preview'"
                >
                    <i class="fas fa-folder">
                    </i>
                    View
                </a>
                <a class="btn btn-info btn-sm"
                   :href="'/admin/post/' + post.id + '/edit'"
                >
                    <i class="fas fa-pencil-alt">
                    </i>
                    Изменить
                </a>


                <a class="btn btn-danger btn-sm"
                   @click="this.openRemovePopup(post)"
                >
                    <i class="fas fa-trash"></i> Удалить
                </a>
            </li>
        </ul>
    </draggable>

    <AlertPopup
        v-if="this.isShowAlert"
        :remove-link="'remove-link'"
        @removePost="handleRemovePost"
        @closePopup="handleClosePopup"
        :post="this.removePost"
        :message="this.errorMessage"
    >
        <template v-slot:text>
            Вы действительно хотите удалить запись {{ this.removePost ? '(' + this.removePost.title + ')' : '' }}?
        </template>
    </AlertPopup>
    <spinner :class="{'active': spinnerIsActive}"></spinner>
</template>

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
