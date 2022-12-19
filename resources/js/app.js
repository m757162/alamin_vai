import './bootstrap';
import {createApp} from 'vue'
import App from './components/Chat.vue'
import adminChat from './components/admin/adminChat.vue'
import AuthUser from './components/AuthUser.vue'


createApp(App,AuthUser).mount("#app")

createApp(adminChat).mount("#adminApp")


