import {createApp} from 'vue'

import DesignTabs from '@/Components/frontend/design/Tabs.vue'
import HeaderComponent from "@/Components/frontend/HeaderComponent.vue";

import VueLazyLoad from "vue3-lazyload";

const app = createApp({
    components: {
        'design-tabs': DesignTabs,
        'header-component': HeaderComponent,
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
