import { createApp } from 'vue'
import Counter from './components/counter.vue'

const app = createApp()
 
app.component('counter', Counter)
 
app.mount('#app')