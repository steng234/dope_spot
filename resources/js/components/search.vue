<template>
  <div>
    <!-- Desktop view -->
    <div class="relative hidden md:block">
      <div class="md:flex md:items-center md:justify-between md:w-96">
        <div class="block md:relative md:w-full">
          <label for="icon" class="sr-only">Search</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none z-20">
              <svg class="flex-shrink-0 size-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
            </div>
            <input type="text" id="icon" name="icon" class="py-2 pl-10 pr-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600" placeholder="Search" v-model="searchTerm">
          </div>
          <div  v-if="hasResult" class="absolute top-full left-0 w-full bg-white rounded-lg shadow-lg mt-2 z-30 px-4 py-3">
            <ul>
              <li v-for="(brand, brandId) in matrix.brand" :key="brandId">
                Brand: {{ brand }} <br>
                
              </li>
            </ul>

            <ul>
            <li v-for="(category, categoryId) in matrix.category" :key="categoryId">
                Category: {{ category }} <br>
                  </li>
                </ul>
                
                <ul>
                  <li v-for="(product, index) in matrix.product" :key="index">
                    View product: {{ product.name }}
                  </li>
                </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Mobile view -->
    <div class="relative block md:hidden w-full">
      <div class="flex items-center justify-start px-2">
        <div class="block relative">
          <button @click="toggleSearch" class="inline-flex justify-center w-full border border-transparent rounded-md shadow-sm px-4 py-2 bg-blue-600 text-base text-white font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm relative">
            <svg class="flex-shrink-0 size-6 text-white p-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
          </button>   
        </div>
      </div>
   
      <!-- Centered input field at the bottom -->
      <div v-if="isSearchVisible" class="absolute transform -translate-x-36 w-lvw z-30 bg-white">
        <input type="text" id="searchInput" class="bg-white w-full border border-transparent rounded-lg z-30 px-4 py-3 w-full" placeholder="Search" v-model="searchTerm">
        <div v-if="hasResult" class="bg-white w-full rounded-lg shadow-lg mt-2 z-30 px-1 py-3">
          <ul>
              <li v-for="(brand, brandId) in matrix.brand" :key="brandId">
                Brand: {{ brand }} <br>
                
              </li>
            </ul>

            <ul>
            <li v-for="(category, categoryId) in matrix.category" :key="categoryId">
                Category: {{ category }} <br>
                  </li>
                </ul>
                
                <ul>
                  <li v-for="(product, index) in matrix.product" :key="index">
                    View product: {{ product.name }}
                  </li>
                </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      searchTerm: '',
      matrix: {
        brand: [],
        category: [],
        product: {}
      },
      isSearchVisible: false,
      hasResult: false
    };
  },
  watch: {
    searchTerm(newVal) {
      this.search(newVal);
    }
  },
  methods: {
    toggleSearch() {
      this.isSearchVisible = !this.isSearchVisible;
    },
    search(searchTerm) {
      if (searchTerm.trim() !== '') {
        axios.get('/search-items', {
          params: {
            searchTerm: searchTerm
          }
        })
        .then(response => {
          this.matrix = response.data.result;
          this.hasResult= true
        })
        .catch(error => {
          console.error(error);
        });
      } else {
        this.matrix = {
          brand: [],
          category: [],
          product: {},    
        };
        this.hasResult= false
      }
    }
  }
};
</script>
  