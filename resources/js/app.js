import { createApp } from 'vue'
import buttonfordata from './components/buttonForData.vue'
import buttonforpassword from './components/buttonForPassword.vue'
const app = createApp()
 
app.component('button-for-data', buttonfordata) 
app.component('button-for-password', buttonforpassword) 
app.mount('#app')