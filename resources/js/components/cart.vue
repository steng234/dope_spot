<template>
    <div  class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Product
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Brand
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Size
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Color
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Quantity
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="(variation, index) in variations" :key="index">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-20">
                                <img class="w-20 object-cover rounded-xl" :src="getImageUrl(variation)" :alt="variation.product.name">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ variation.product.name }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ variation.product.brand.name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ variation.price }}$</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ variation.size }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ variation.color }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <select v-model="variation.quantity" @change="updateQuantity(variation)" class="mt-1 block w-14 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:border-blue-600 focus:ring-blue-600 sm:text-sm appearance-none">
                            <option :key="quantity" :value="variation.quantity" selected>{{ variation.pivot.quantity }}</option>
                            
                            <template v-for="quantity in quantities">
                                <option v-if="quantity != variation.pivot.quantity" :key="quantity" :value="quantity">{{quantity}}</option>
                            </template>

                        </select>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap fles items-center justify-center">
                            <button @click="removeFromCart(variation)" class="p-1 text-red-600 hover:text-gray-900">
                                <img width="24" height="24" src="https://img.icons8.com/material-outlined/48/filled-trash.png" alt="filled-trash"/>
                            </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: ['variations'],
    data() {
        return {
            // Define available quantities for the dropdown
            quantities: [1, 2, 3, 4, 5] // You can modify this array as needed
        };
    },
    methods: {
        getImageUrl(variation) {
            const imageUrl = `/images/${variation.product.category.name}/${variation.product.brand.name}/${variation.product.type.name}/${variation.product.images[0].image}`;
            return imageUrl;
        },
        updateQuantity(variation) {
            // Update the quantity in the database
            axios.post('/cart/updateQuantity', { variationId: variation.id, quantity: variation.quantity })
                .then(response => {
                    console.log('Quantity updated:', response.data.message);
                    location.reload
                    // Optionally, you can update the cart items count or reload the cart data
                })
                .catch(error => {
                    console.error('Error updating quantity:', error);
                });
        },
        removeFromCart(variation) {
            // Add logic to remove the product from the cart
            axios.post('/cart/remove', { variationId: variation.id })
                .then(response => {
                    console.log('Product removed from cart:', response.data.message);
                    location.reload();
                    // Update the cart items count or reload the cart data if needed
                })
                .catch(error => {
                    console.error('Error removing product from cart:', error);
                });
        }
    }
};
</script>

<style scoped>
/* Add your component-specific styles here */
</style>
