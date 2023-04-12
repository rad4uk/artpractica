import {createApp} from 'vue'
import { createPinia } from 'pinia'
import LogoutComponent from '@/Components/Adminlte/LogoutComponent.vue'
import Portfolio from '@/Components/Adminlte/Widget/Portfolio.vue'
import WidgetContainer from '@/Components/Adminlte/Widget/WidgetContainer.vue'
import CreateFormComponent from '@/Components/Adminlte/Post/CreateFormComponent.vue'
const app = createApp({
    components: {
        'logout-component': LogoutComponent,
        'portfolio-widget': Portfolio,
        'widget-container': WidgetContainer,
        'new-form-component': CreateFormComponent,
    }
});
app.use(createPinia())
app.mount("#app")
