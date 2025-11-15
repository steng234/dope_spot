<template>
 <div class="relative block md:hidden w-full bg-white">
      <div class="flex items-center justify-start px-2 bg-white">
        <div class="block relative">
          <button
            @click="$emit('toggle-search')"
            class="inline-flex justify-center w-full border border-transparent rounded-md shadow-sm px-4 py-2 bg-blue-600 text-base text-white font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm relative"
          >
            <svg class="flex-shrink-0 size-6 text-white p-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="11" cy="11" r="8"/>
              <path d="m21 21-4.3-4.3"/>
            </svg>
          </button>
        </div>
      </div>
      <div v-if="isSearchVisible" class="absolute transform w-64 z-30 bg-white shadow-lg rounded-lg mt-2">
        <input
          type="text"
          id="searchInput"
          class="bg-white w-full border border-gray-300 rounded-lg z-30 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
          placeholder="Search"
          :value="searchTerm"
          @input="$emit('update-search', $event.target.value)"
        />
        <ResultsList v-if="hasResult" :matrix="matrix" />
      </div>
    </div>
</template>

<script>
import ResultsList from './ResultList.vue';

export default{
  props:{
    searchTerm: String,
    isSearchVisible: Boolean,
    hasResult: Boolean,
    matrix: Object
  },
  components:{
    ResultsList
  }
};
</script>
