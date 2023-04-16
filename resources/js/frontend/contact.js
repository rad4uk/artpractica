import {createApp} from 'vue'
import HeaderComponent from "@/Components/frontend/HeaderComponent.vue";

const app = createApp({
    components: {
        'header-component': HeaderComponent,
    }
});

app.mount("#app")
