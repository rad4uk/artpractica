import {createApp} from 'vue'
import { createPinia } from 'pinia'

import LogoutComponent from '@/Components/Adminlte/LogoutComponent.vue'
import CategoryContent from '@/Components/Adminlte/Category/CategoryContent.vue'
const app = createApp({
    components: {
        'logout-component': LogoutComponent,
        'category-content': CategoryContent
    }
});
app.use(createPinia());
app.mount("#app")
