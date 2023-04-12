import {createApp} from 'vue'
import { createPinia } from 'pinia'
import VueLazyLoad from 'vue3-lazyload';

import ProfessionalComponent from '@/Components/frontend/home/ProfessionalComponent.vue'
import FeedbackComponent from '@/Components/frontend/FeedbackComponent.vue'
import PreviewComponent from '@/Components/frontend/home/PreviewComponent.vue'

const app = createApp({
    components: {
        'professional-component': ProfessionalComponent,
        'preview-component': PreviewComponent,
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
