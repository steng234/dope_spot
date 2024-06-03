<template>
    <div class="absolute top-full left-0 w-full bg-white rounded-lg shadow-lg mt-2 z-30 px-4 py-3">
     <ul>
       <li v-for="(brand, brandId) in matrix.brand" :key="brandId" class="py-2 border-b border-gray-200">
         <a :href="`/product?brand_id=${brandId}`">
         <span class="font-semibold">Brand:</span> {{ brand }}
         </a>
       </li>
     </ul>
     <ul>
         <li v-for="(category, categoryId) in matrix.category" :key="categoryId" class="py-2 border-b border-gray-200">
         <a :href="`/product?category_id=${categoryId}`">
           <span class="font-semibold">Category:</span> {{ category }}
         </a>
       </li>
     </ul>
     <ul>
       <li v-for="(product, productId) in matrix.product" :key="productId" class="py-2 border-b border-gray-200">
         <a :href="`/product/${productId}`">
              <span class="font-semibold">View product:</span> {{ product }}
         </a>
       </li>
     </ul>
   </div>
   </template>
   
   <script>
 
 export default {
   props: {
     matrix: {
       type: Object,
       required: true
     }
   },
   watch: {
     matrix: {
       deep: true,
       handler(matrix) {
         console.log(matrix);
       }
     }
   }
 };
   </script>
   