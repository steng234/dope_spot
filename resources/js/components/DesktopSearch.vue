<template>
  <div class="relative hidden md:block">
    <div class="md:flex md:items-center md:justify-between md:w-96">
      <div class="block md:relative md:w-full">
        <label for="icon" class="sr-only">Search</label>
        <div class="relative">
          <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none z-20">
            <svg class="flex-shrink-0 size-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="11" cy="11" r="8"/>
              <path d="m21 21-4.3-4.3"/>
            </svg>
          </div>
          <input
            type="text"
            id="icon"
            name="icon"
            class="py-2 pl-10 pr-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500"
            placeholder="Search"
            :value="searchTerm"
            @input="$emit('update-search', $event.target.value)"
          />
        </div>
        <ResultsList v-if="hasResult" :matrix="matrix" />
      </div>
    </div>
  </div>
</template>
  
<script>
  import ResultsList from './ResultList.vue';
  
  export default{
    props:{
      searchTerm: String,
      hasResult: Boolean,
      matrix: Object
    },
    components:{
      ResultsList
    }
  };
</script>
  