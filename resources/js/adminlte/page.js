import {createApp} from 'vue'
import LogoutComponent from '@/Components/Adminlte/LogoutComponent.vue'
import NewComponent from '@/Components/Adminlte/Page/Home/NewComponent.vue'
import { createPinia } from 'pinia'
const app = createApp({
    components: {
        'logout-component': LogoutComponent,
        'new-component': NewComponent,
    }
});
app.use(createPinia())
app.mount("#app")
