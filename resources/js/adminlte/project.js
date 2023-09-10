import {createApp} from 'vue'
import { createPinia } from 'pinia'
import LogoutComponent from '@/Components/Adminlte/LogoutComponent.vue'
import Portfolio from '@/Components/Adminlte/Widget/Portfolio.vue'
import WidgetContainer from '@/Components/Adminlte/Widget/WidgetContainer.vue'
import ProjectContent from '@/Components/Adminlte/Post/ProjectContent.vue'
import DraggableComponent from '@/Components/Adminlte/Post/DraggableComponent.vue'
const app = createApp({
    components: {
        'logout-component': LogoutComponent,
        'portfolio-widget': Portfolio,
        'widget-container': WidgetContainer,
        'project-content': ProjectContent,
        'draggable-component': DraggableComponent,
    }
});
app.use(createPinia())
app.mount("#app")
