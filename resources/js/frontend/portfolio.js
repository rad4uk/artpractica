import {createApp} from 'vue'
import { createPinia } from 'pinia'
import VueLazyLoad from 'vue3-lazyload';

import ProjectComponent from '@/Components/frontend/portfolio/Project.vue';
import ProjectItemComponent from '@/Components/frontend/portfolio/ProjectItem.vue';
import FeedbackComponent from '@/Components/frontend/FeedbackComponent.vue'


const app = createApp({
    components: {
        'project-component': ProjectComponent,
        'project-item-component': ProjectItemComponent,
        'feedback-component': FeedbackComponent,
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
