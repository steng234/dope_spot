import { createApp } from 'vue'
import Counter from './components/counter.vue'
import about from './components/about.vue'

const app = createApp()
 
app.component('counter', Counter)
app.component('about', about)
 
app.mount('#app')