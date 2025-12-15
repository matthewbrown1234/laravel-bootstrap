import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import { PiniaColada } from '@pinia/colada'

import PrimeVue from 'primevue/config'
import Mui from '@primeuix/themes/material'

import App from './App.vue'
import router from './router'

const app = createApp(App)

app.use(createPinia())
app.use(PiniaColada, {
  queryOptions: {
    // change the stale time for all queries to 0ms
    staleTime: 0,
  },
  mutationOptions: {
    // add global mutation options here
  },
  plugins: [
    // add Pinia Colada plugins here
  ],
})
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
