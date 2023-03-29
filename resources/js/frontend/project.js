import {createApp} from 'vue'
import { createPinia } from 'pinia'
import VueLazyLoad from 'vue3-lazyload';

import ProjectItemComponent from '@/Components/frontend/portfolio/ProjectItem.vue';

const app = createApp({
    components: {
        'project-item-component': ProjectItemComponent,
    }
});
app.use(VueLazyLoad, {
    loading: '',
    error: '',
    lifecycle: {
        loading: (el) => {
        },
        error: (el) => {
        },
        loaded: (el) => {
        }
    }
})
app.use(createPinia());
app.mount("#app")
