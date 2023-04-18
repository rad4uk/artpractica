import {createApp} from 'vue'

import Services from '@/Components/frontend/design/Services.vue'
import HeaderComponent from "@/Components/frontend/HeaderComponent.vue";
import FeedbackComponent from '@/Components/frontend/FeedbackComponent.vue'


import VueLazyLoad from "vue3-lazyload";

const app = createApp({
    components: {
        'services-component': Services,
        'header-component': HeaderComponent,
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
app.mount("#app")
