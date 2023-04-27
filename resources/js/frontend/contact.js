import {createApp} from 'vue'
import HeaderComponent from "@/Components/frontend/HeaderComponent.vue";
import FormComponent from "@/Components/frontend/page/contact/FormComponent.vue";

const app = createApp({
    components: {
        'header-component': HeaderComponent,
        'form-component': FormComponent,
    }
});

app.mount("#app")
