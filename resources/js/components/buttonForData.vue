<template>
    <div>
      <button @click="showModal = true"  type="button" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">modify data</button>
      <modifydata :show-modal="showModal"  @close="showModal = false"  :initial-data="initialData"></modifydata>
    </div>
  </template>
  
  <script>
  import modifydata from "./modifyData.vue"; 
  
  export default{
    components:{
        modifydata
    },
    data(){
      return{
        showModal: false,
        initialData:{ name: '', address: '', city:'',postal:'',state:'',telephone:'' }
      };
    }

  };
  </script>
  