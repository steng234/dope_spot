import { createApp } from 'vue'
import buttonfordata from './components/buttonForData.vue'
import buttonforpassword from './components/buttonForPassword.vue'
import productdetail from './components/product-detail.vue'
import cart from './components/cart.vue'
import '/resources/css/app.css'
const app = createApp()
 
app.component('cart', cart) 
app.component('product-detail', productdetail) 
app.component('button-for-data', buttonfordata) 
app.component('button-for-password', buttonforpassword) 

app.mount('#app')