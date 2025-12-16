import './assets/main.css'

import { createApp } from 'vue'
import { VueQueryPlugin } from '@tanstack/vue-query'
import { createPinia } from 'pinia'

import PrimeVue from 'primevue/config'
import Mui from '@primeuix/themes/material'

import App from './App.vue'
import router from './router'

const app = createApp(App)
app.use(VueQueryPlugin)
app.use(createPinia())
app.use(router)
app.use(PrimeVue, {
  theme: {
    preset: Mui,
    options: {
      darkModeSelector: false,
    },
  },
})
app.mount('#app')
