import {createApp} from 'vue'
import { createPinia } from 'pinia'
import VueLazyLoad from 'vue3-lazyload';

import ProjectItemComponent from '@/Components/frontend/portfolio/ProjectItem.vue';
import FeedbackComponent from '@/Components/frontend/FeedbackComponent.vue'
import PostSlider from '@/Components/frontend/project/PostSlider.vue'
import PreviewComponent from '@/Components/frontend/project/PreviewComponent.vue'

const app = createApp({
    components: {
        'project-item-component': ProjectItemComponent,
        'feedback-component': FeedbackComponent,
        'post-slider-component': PostSlider,
        'preview-component': PreviewComponent,
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
