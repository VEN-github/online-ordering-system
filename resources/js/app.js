import './bootstrap'
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'
import { Icon } from '@iconify/vue'

import App from './App.vue'
import router from './router'
import LoadingScreen from '@/components/UI/loader/LoadingScreen.vue'

const app = createApp(App)

const pinia = createPinia()
pinia.use(piniaPluginPersistedstate)

app.use(pinia)
app.use(router)
app.component('Icon', Icon)
app.component('LoadingScreen', LoadingScreen)

app.mount('#app')
