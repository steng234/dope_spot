<template>
    <div class=" px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
      <div class="mx-auto">
        <div class="grid grid-cols-1 sm:grid-cols-2 border border-gray-200  w-full rounded-xl p-5 dark:border-gray-700">
          <!-- Product Image -->
          <div class="aspect-w-16 aspect-h-11 col-span-1">
            <img id="main-image" :src="mainImage" :alt="productName" class="w-full object-cover rounded-xl">
            <div class="mt-4 col-span-1 ">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-300">Additional Photos:</h3>
            <ul class='mt-2 grid grid-cols-5 gap-4'>
            <li v-for="(image, index) in additionalImages" :key="index" class=""> 
              <img :src="image" :alt="productName" class="h-20 w-20 object-cover rounded-lg" @click="changeMainImage(image)">
            </li>
          </ul>
          </div>
          </div>
          <div class="pl-4 flex items-center justify-center col-span-1">
               <div class="md:w-80 w-5/6">
                    <!-- Product Name -->
                    <h2 class="mt-5 text-2xl font-bold text-gray-800 dark:text-gray-300">{{ productName }}</h2>
                    <!-- Brand -->
                    <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-gray-300">Brand: {{ brandName }}</p>
                    <!-- Price -->
                    <p class="mt-2 text-lg font-bold text-gray-800 dark:text-gray-300">${{ productPrice }}</p>
                    <!-- Description -->
                    <p class="mt-4 text-base text-gray-600 dark:text-gray-400">{{ productDescription }}</p>
                    <!-- Size dropdown -->
                    <div class="mt-4">
                      <label for="size" class="text-sm font-semibold text-gray-800 dark:text-gray-300">Size:</label>
                      <select id="size" v-model="selectedSize" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:border-blue-600 focus:ring-blue-600 sm:text-sm appearance-none">
                      <template v-for="(variation, index) in variations">
                     <option v-if="index === 0 || variation.size !== variations[index - 1].size" :key="variation.id" :value="variation.size">{{ variation.size }}</option>
                    </template>
                  </select>
                    </div>
                    <!-- Color dropdown -->
                    <div class="mt-4">
                      <label for="color" class="text-sm font-semibold text-gray-800 dark:text-gray-300">Color:</label>
                      <select id="color" v-model="selectedColor" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-600 focus:border-blue-600 sm:text-sm appearance-none">
                        <template v-for="(variation, index) in variations">
                        <option v-if="index === 0 || variation.color !== variations[index - 1].color" :key="variation.id" :value="variation.color">{{ variation.color }}</option>
                      </template>
                       </select>
                    </div>
                    <!-- Additional Information -->
                    <div class="pt-6 inline-flex items-center grid grid-cols-2">
                        <div class="px-4 flex items-center justify-center ">
                        <a class="py-3 px-4 gap-x-2 sm:text-sm text-xs  font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 h-full">
                            shop&nbsp;now
                        </a>
                        </div>
                           <div class="px-4 flex items-center justify-center ">
                            <button @click="addToCart" class="py-3 px-4 inline-flex items-center gap-x-2 sm:text-sm text-xs font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 h-full">
                              add&nbsp;to&nbsp;cart
                </button>
                </div> 
            </div>
            </div>
          </div>
          
          

        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  export default {
    props: {
      productName: String,
      brandName: String,
      productPrice: String,
      productDescription: String,
      mainImage: String,
      additionalImages: Array,
      productId: String,
      variations: Array // Array of product variations
    },
    data() {
    return {
      selectedSize: this.variations[0].size,
      selectedColor: this.variations[0].color,
      productPrice: this.variations[0].price,
      variationId: this.variations[0].id
    };
  },
  watch: {
    selectedSize: function(newSize) {
      this.updatePrice(newSize, this.selectedColor);
    },
    selectedColor: function(newColor) {
      this.updatePrice(this.selectedSize, newColor);
    }
  },
    methods: {
      changeMainImage: function(image) {
        document.getElementById('main-image').src = image;
      },

      addToCart: function() {
      // Send a POST request to your backend to add the product to the cart
      axios.post('/cart/add', {variationId: this.variationId } )
        .then(response => {
          // Handle success response
          console.log('Product added to cart:', response.data.message);
        })
        .catch(error => {
          // Handle error response
          console.error('Error adding product to cart:', error);
        });
    },
    shopNow: function() {
      // Send a POST request to your backend to add the product to the cart
      axios.post('/shopNow', {variationId: this.variationId } )
        .then(response => {
          // Handle success response
          console.log('Product added to cart:', response.data.message);
        })
        .catch(error => {
          // Handle error response
          console.error('Error adding product to cart:', error);
        });
    },
    mounted() {
    
      // Initialize selectedSize and selectedColor with the first elements from variations array
      this.selectedSize = this.variations[0].size;
      this.selectedColor = this.variations[0].color;
      // Update the product price
      this.updatePrice(this.selectedSize, this.selectedColor);
    
  },
    updatePrice: function(size, color) {
      // Find the variation with the selected size and color
      const variation = this.variations.find(variation => variation.size === size && variation.color === color);
      this.variationId= variation.id
      // Update the productPrice if variation is found, otherwise set it to 'N/A'
      this.productPrice = variation ? variation.price : 'N/A';
    }
    }
  };
  </script>
  
  <style>
 @import url('/resources/css/app.css');
  </style>
  