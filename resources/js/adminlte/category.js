import {createApp} from 'vue'
import { createPinia } from 'pinia'

import LogoutComponent from '@/Components/Adminlte/LogoutComponent.vue'
const app = createApp({
    components: {
        'logout-component': LogoutComponent,
    }
});
app.use(createPinia());
app.mount("#app")
