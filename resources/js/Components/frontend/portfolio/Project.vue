<template>
    <div class="project">
        <div class="container">
            <div class="project__row">
                <ProjectItem
                    class="posts__post post post_active"
                    :item="item"
                    :key="index"
                    v-for="(item, index) in this.items"
                ></ProjectItem>
            </div>
            <div class="posts__loading" v-if="more"> <!-- добавили условный атрибут v-if -->
            </div>
        </div>
    </div>
</template>

<script>
import ProjectItem from "./ProjectItem.vue";
export default {
    name: "Project",
    props: ['posts', 'category'],
    components: {
        ProjectItem
    },
    data: () => {
        return {
            items: null,
            page: 1, /* начальная страница для получения постов */
            more: true /* как только закончатся посты, назначаем false */
        }
    },
    mounted() {
        console.log(this.posts)
        this.items = this.posts
        this.setLoadingObserver()
    },
    methods: {
        async getNextItems(){
            await axios.get('/' + this.category.id + '/next/posts/' + this.items.length)
                .then( res => {
                    if (res.status === 200 && res.data.length > 0){
                        res.data.forEach( item => {
                            this.items.push(item)
                        })
                    }

                }).catch(err => {
                    console.log(err)
                })
        },

        /* создаём метод для наблюдения за лоадером */
        setLoadingObserver() {
            /* создаём наблюдение */
            const loadingObserver = new IntersectionObserver(entries => {
                entries.forEach(entry => { /* для каждого элемента */
                    if (entry.isIntersecting) { /* если элемент в видимой области браузера */
                        if (this.page > 10) { /* если значение страницы уже больше 10 */
                            this.more = false /* то назначаем значение false */
                            return /* и прекращаем выполнение функции */
                        }

                        this.getNextItems() /* вызываем метод для получения постов */
                        this.page++ /* увеличиваем значение страницы на 1 */

                        // setTimeout(() => { /* для наглядности добавим небольшую задержку */
                        //     this.getNextItems() /* вызываем метод для получения постов */
                        //     this.page++ /* увеличиваем значение страницы на 1 */
                        // }, 1000) /* задержка перед получением постов 1 секунда для наглядности  */

                    }
                })
            });
            /* указываем, что наблюдаем за лоадером */
            loadingObserver.observe(document.querySelector('.posts__loading'))
        },

        /* создаём метод для наблюдения за постами */
        setPostsObserver() {
            /* создаём наблюдение */
            const postsObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => { /* для каждого элемента */
                    if (entry.isIntersecting) { /* если элемент в видимой области браузера */
                        entry.target.classList.add('post_active') /* добавляем активный класс наблюдаемому элементу, то есть посту */
                        observer.unobserve(entry.target); /* и отключаем наблюдение за этим постом */
                    }
                })
            });

            document.querySelectorAll('.posts__post:not(.post_active)').forEach(post => { /* получаем только неактивные посты */
                postsObserver.observe(post) /* указываем, что наблюдаем за ними */
            })
        },
    },
    /* когда очередные новые посты будут загружены, запускаем метод наблюдения за ними */
    updated() {
        this.setPostsObserver()
    }

}
</script>

<style scoped>

</style>
