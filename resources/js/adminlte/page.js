import {createApp} from 'vue'
import LogoutComponent from '@/Components/Adminlte/LogoutComponent.vue'
import NewComponent from '@/Components/Adminlte/Page/Home/NewComponent.vue'
import DefaultComponent from '@/Components/Adminlte/Page/DefaultComponent.vue'
import EditComponent from '@/Components/Adminlte/Page/About/EditComponent.vue'
import ContactEditComponent from '@/Components/Adminlte/Page/Contact/EditComponent.vue'
import CKEditor from '@ckeditor/ckeditor5-vue';
import { createPinia } from 'pinia'

const app = createApp({
    components: {
        'logout-component': LogoutComponent,
        'new-component': NewComponent,
        'default-component': DefaultComponent,
        'edit-component': EditComponent,
        'contact-edit-component': ContactEditComponent,
    }
});
app.use(createPinia())
app.use(CKEditor)
app.mount("#app")
