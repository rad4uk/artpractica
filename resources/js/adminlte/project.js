import {createApp} from 'vue'
import LogoutComponent from '@/Components/Adminlte/LogoutComponent.vue'
import Portfolio from '@/Components/Adminlte/Widget/Portfolio.vue'
import WidgetContainer from '@/Components/Adminlte/Widget/WidgetContainer.vue'
const app = createApp({
    components: {
        'logout-component': LogoutComponent,
        'portfolio-widget': Portfolio,
        'widget-container': WidgetContainer
    }
});
app.mount("#app")
