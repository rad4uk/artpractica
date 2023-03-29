import {createApp} from 'vue'
import { createPinia } from 'pinia'

import CategoryImage from '@/Components/Adminlte/Category/Edit/Image.vue'
import CategoryContent from '@/Components/Adminlte/Category/CategoryIndexContent.vue'
import LogoutComponent from '@/Components/Adminlte/LogoutComponent.vue'
const app = createApp({
    components: {
        'category-image': CategoryImage,
        'category-content': CategoryContent,
        'logout-component': LogoutComponent,
    }
});
app.use(createPinia());
app.mount("#app")
