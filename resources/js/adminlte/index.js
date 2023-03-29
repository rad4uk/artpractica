import {createApp} from 'vue'
import LogoutComponent from '@/Components/Adminlte/LogoutComponent.vue'
const app = createApp({
    components: {
        'logout-component': LogoutComponent,
    }
});
app.mount("#app")
