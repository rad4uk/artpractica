import {createApp} from 'vue'
import { createPinia } from 'pinia'

import FormComponent from '@/Components/Adminlte/Service/FormComponent.vue'
import CKEditor from '@ckeditor/ckeditor5-vue';
const app = createApp({
    components: {
        'form-component': FormComponent,
    }
});
app.use(createPinia())
app.use(CKEditor)
app.mount("#app")
