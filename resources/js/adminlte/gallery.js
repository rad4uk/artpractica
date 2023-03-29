import {createApp} from 'vue'
import { createPinia } from 'pinia'
import FormGallery from '@/Components/Adminlte/Gallery/Form.vue'
import ContentGallery from '@/Components/Adminlte/Gallery/Content.vue'
import LogoutComponent from '@/Components/Adminlte/LogoutComponent.vue'


const app = createApp({
    components: {
        'form-gallery': FormGallery,
        'content-gallery': ContentGallery,
        'logout-component': LogoutComponent,
    },
});
app.use(createPinia())
// app.use(useGalleryStore)
app.mount("#app")
